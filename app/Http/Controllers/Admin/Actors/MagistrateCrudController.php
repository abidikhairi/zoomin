<?php


namespace App\Http\Controllers\Admin\Actors;


use App\AppRoles;
use App\Models\Administration\Room;
use App\Models\Magistrate;
use App\Models\Role;
use App\Models\User;
use App\Notifications\MagistrateCreated;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;

class MagistrateCrudController extends CrudController
{
    use ListOperation, CreateOperation;

    /**
     * @throws \Exception
     */
    public function setup()
    {
        $this->crud->setModel(Magistrate::class);
        $this->crud->setRoute('/admin/magistrate');
        $this->crud->setEntityNameStrings(__('names.administration.magistrate'), __('names.administration.magistrates'));
    }

    public function setupListOperation()
    {
        $this->crud->addColumns([
            [
                'name' => 'first_name',
                'entity' => 'user',
                'attribute' => 'first_name',
                'label' => __('fields.user.first_name')
            ],
            [
                'name' => 'last_name',
                'entity' => 'user',
                'attribute' => 'last_name',
                'label' => __('fields.user.last_name')
            ],
            [
                'name' => 'email',
                'entity' => 'user',
                'attribute' => 'email',
                'label' => __('fields.user.email')
            ],
            [
                'name' => 'room',
                'entity' => 'room',
                'attribute' => 'name',
                'label' => __('fields.room.name')
            ]
        ]);
    }

    public function setupCreateOperation()
    {
        $this->crud->addFields([
            [
                'name' => 'first_name',
                'label' => __('fields.user.first_name')
            ],
            [
                'name' => 'last_name',
                'label' => __('fields.user.last_name')
            ],
            [
                'name' => 'email',
                'type' => 'email',
                'label' => __('fields.user.email')
            ],
            [
                'name' => 'room',
                'entity' => 'room',
                'type' => 'select2',
                'label' => __('fields.room.name')
            ]
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required', 'email', 'unique:users'],
            'room' => ['required']
        ]);
        $data = $request->all();

        $room = Room::find($data['room']);
        $role = Role::query()->where('name', '=', AppRoles::ROLE_MAGISTRATE)->firstOrFail();
        $plainPassword = uniqid();

        $user = new User([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($plainPassword)
        ]);

        $user->save();
        $user->attachRole($role);

        $magistrate = new Magistrate();

        $magistrate->room()->associate($room);
        $magistrate->user()->associate($user);
        $magistrate->save();

        Notification::send($user, new MagistrateCreated($plainPassword, $user->email));

        return redirect()->to($request->get('http_referrer', '/admin'));
    }
}
