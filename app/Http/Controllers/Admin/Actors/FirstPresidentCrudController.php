<?php

namespace App\Http\Controllers\Admin\Actors;

use App\AppRoles;
use App\Models\FirstPresident;
use App\Models\Role;
use App\Models\User;
use App\Notifications\FirstPresidentCreated;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;

class FirstPresidentCrudController extends CrudController
{
    use ListOperation, CreateOperation;

    /**
     * @throws \Exception
     */
    public function setup()
    {
        $this->crud->setModel(FirstPresident::class);
        $this->crud->setRoute('/admin/first-president');
        $this->crud->setEntityNameStrings(('الرئيس الأول'), ('الرئيس الأول'));
    }

    public function setupListOperation()
    {
        $this->crud->addColumns([
            [
                'name' => 'first_name',
                'entity' => 'user',
                'attribute' => 'first_name',
                'label' => __('forms.fields.first_name')
            ],
            [
                'name' => 'last_name',
                'entity' => 'user',
                'attribute' => 'last_name',
                'label' => __('forms.fields.last_name')
            ],
            [
                'name' => 'email',
                'entity' => 'user',
                'attribute' => 'email',
                'label' => __('forms.fields.email')
            ]
        ]);
    }

    public function setupCreateOperation()
    {
        $this->crud->addFields([
            [
                'name' => 'first_name',
                'label' => __('forms.fields.first_name')
            ],
            [
                'name' => 'last_name',
                'label' => __('forms.fields.last_name')
            ],
            [
                'name' => 'email',
                'type' => 'email',
                'label' => __('forms.fields.email')
            ]
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required', 'email', 'unique:users']
        ]);
        $data = $request->all();

        $role = Role::query()->where('name', '=', AppRoles::ROLE_FIRST_PRESIDENT)->firstOrFail();
        $plainPassword = uniqid();

        $user = new User([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($plainPassword)
        ]);

        $user->save();
        $user->attachRole($role);

        $firstPresident = new FirstPresident();
        $user->firstPresident()->save($firstPresident);

        Notification::send($user, new FirstPresidentCreated($plainPassword, $user->email));

        return redirect()->to($request->get('http_referrer', '/admin'));
    }
}
