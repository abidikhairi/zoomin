<?php


namespace App\Http\Controllers\Admin;


use App\Models\Permission;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Illuminate\Http\Request;

class PermissionCrudController extends CrudController
{
    use ListOperation, CreateOperation, DeleteOperation;

    public function setup()
    {
        $this->crud->setModel(Permission::class);
        $this->crud->setRoute('/admin/permission');
        $this->crud->setEntityNameStrings(__('permission'), __('permissions'));
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

        Permission::create([
            'name' => $request->name,
            'display_name' => $request->display_name,
            'description' => $request->description
        ]);

        return redirect()->to($request->get('http_referrer', '/admin'));
    }
}
