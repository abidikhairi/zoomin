<?php


namespace App\Http\Controllers\Admin;


use App\Models\Role;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
use Illuminate\Http\Request;

class RoleCrudController extends CrudController
{
    use ListOperation, UpdateOperation;

    /**
     * @throws \Exception
     */
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
