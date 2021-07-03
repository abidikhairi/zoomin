<?php


namespace App\Http\Controllers\Admin\Actors;


use App\AppRoles;
use App\Models\Administration\Room;
use App\Models\Role;
use App\Models\RoomPresident;
use App\Models\User;
use App\Notifications\RoomPresidentCreated;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;

class RoomPresidentCrudController extends CrudController
{
    use ListOperation, CreateOperation, DeleteOperation;

    public function setup()
    {
        $this->crud->setModel(RoomPresident::class);
        $this->crud->setRoute('/admin/room-president');
        $this->crud->setEntityNameStrings(__('Room President'), __('Room Presidents'));
    }

    public function setupListOperation()
    {
        $this->crud->addColumns([
            [
                'name' => 'first_name',
                'entity' => 'user',
                'attribute' => 'first_name',
                'label' => 'first_name'
            ],
            [
                'name' => 'last_name',
                'entity' => 'user',
                'attribute' => 'last_name',
                'label' => 'last_name'
            ],
            [
                'name' => 'email',
                'entity' => 'user',
                'attribute' => 'email',
                'label' => 'email'
            ],
            [
                'name' => 'room',
                'entity' => 'room',
                'attribute' => 'name'
            ]
        ]);
    }

    public function setupCreateOperation()
    {
        $this->crud->addFields([
            [
                'name' => 'first_name',
            ],
            [
                'name' => 'last_name',
            ],
            [
                'name' => 'email',
                'type' => 'email'
            ]
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required', 'email', 'unique:users'],
        ]);

        $data = $request->all();

        $role = Role::query()->where('name', '=', AppRoles::ROLE_ROOM_PRESIDENT)
            ->firstOrFail();
        $plainPassword = uniqid();

        $user = new User([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($plainPassword)
        ]);

        $user->save();
        $user->attachRole($role);

        $roomPresident = new RoomPresident();
        $roomPresident->user()->associate($user);
        $roomPresident->save();

        Notification::send($user, new RoomPresidentCreated($plainPassword, $user->email));

        return redirect()->to($request->get('http_referrer', '/admin'));
    }
}
