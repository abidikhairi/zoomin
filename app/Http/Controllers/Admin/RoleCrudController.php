<?php


namespace App\Http\Controllers\Admin;


use App\Models\Role;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
use Illuminate\Http\Request;

class RoleCrudController extends CrudController
{
    use ListOperation, CreateOperation, UpdateOperation, DeleteOperation;

    public function setup()
    {
        $this->crud->setModel(Role::class);
        $this->crud->setRoute('/admin/role');
        $this->crud->setEntityNameStrings(trans('role'), trans('roles'));
    }

    public function setupListOperation()
    {
        $this->crud->addColumns([
            [
                'name' => 'display_name',
                'label' => 'display_name'
            ],
            [
                'name' => 'description',
                'label' => 'description',
            ],
            [
                'name' => 'permissions',
                'entity' => 'permissions',
            ]
        ]);
    }

    public function setupCreateOperation()
    {
        $this->crud->addFields([
            [
                'name' => 'name'
            ],
            [
                'name' => 'display_name'
            ],
            [
                'name' => 'description'
            ],
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255'
        ]);

        Role::create([
            'name' => $request->name,
            'display_name' => $request->display_name,
            'description' => $request->description
        ]);

        return redirect()->to($request->get('http_referrer', '/admin'));
    }

    public function setupUpdateOperation()
    {
        $this->crud->addField([
            'name' => 'permissions',
            'entity' => 'permissions',
            'type' => 'select2_multiple'
        ]);
    }

    public function update(Request $request)
    {
        $data = $request->all();

        $role = Role::query()->where('id', '=', $data['id'])->firstOrFail();
        $role->permissions()->sync($data['permissions']);

        return redirect()->to($request->get('http_referrer', '/admin'));
    }

}
