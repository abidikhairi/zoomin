<?php


namespace App\Http\Controllers\Admin\Citizen;


use App\Models\Citizen\ClaimType;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;

class ClaimTypeCrudController extends CrudController
{
    use ListOperation, CreateOperation;

    public function setup()
    {
        $this->crud->setModel(ClaimType::class);
        $this->crud->setRoute('admin/claim-type');
        $this->crud->setEntityNameStrings(__('claim.type'), __('claim.types'));
        $this->crud->enableExportButtons();
    }

    public function setupListOperation()
    {
        $this->crud->addColumns([
            [
                'name' => 'name'
            ]
        ]);
    }

    public function setupCreateOperation()
    {
        $this->crud->addFields([
            [
                'name' => 'name'
            ]
        ]);
    }
}
