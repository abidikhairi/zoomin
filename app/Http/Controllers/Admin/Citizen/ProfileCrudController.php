<?php


namespace App\Http\Controllers\Admin\Citizen;


use App\Models\Citizen\Profile;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;

class ProfileCrudController extends CrudController
{
    use ListOperation, CreateOperation, DeleteOperation;

    public function setup()
    {
        $this->crud->setModel(Profile::class);
        $this->crud->setRoute('admin/profile');
        $this->crud->setEntityNameStrings(__('profile'), __('profiles'));
        $this->crud->enableExportButtons();
    }

    public function setupListOperation()
    {
        $this->crud->addColumns([
            [
                'name' => 'name'
            ],
            [
                'name' => 'priority'
            ]
        ]);
    }

    public function setupCreateOperation()
    {
        $this->crud->addFields([
            [
                'name' => 'name',
                'type' => 'text'
            ],
            [
                'name' => 'priority',
                'type' => 'number'
            ]
        ]);
    }

}
