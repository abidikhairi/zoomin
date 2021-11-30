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
        $this->crud->setEntityNameStrings(('صفة'), ('الصفات'));
        $this->crud->enableExportButtons();
    }

    public function setupListOperation()
    {
        $this->crud->addColumns([
            [
                'name' => 'name',
                'label' => 'صفة'
            ],
            [
                'name' => 'priority',
                'label' => 'الأولوية'
            ]
        ]);
    }

    public function setupCreateOperation()
    {
        $this->crud->addFields([
            [
                'name' => 'name',
                'type' => 'text',
                'label' => 'صفة'
            ],
            [
                'name' => 'priority',
                'type' => 'number',
                'label' => 'الأولوية'
            ]
        ]);
    }

}
