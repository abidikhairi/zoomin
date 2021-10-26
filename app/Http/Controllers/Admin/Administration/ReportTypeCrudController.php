<?php

namespace App\Http\Controllers\Admin\Administration;

use App\Models\CourtOfAudit\ReportType;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;

class ReportTypeCrudController extends CrudController
{
    use ListOperation, CreateOperation, DeleteOperation;

    public function setup()
    {
        $this->crud->setModel(ReportType::class);
        $this->crud->setRoute('admin/report-type');
        $this->crud->setEntityNameStrings(__('report-type'), __('report-type'));
    }

    public function setupListOperation() {
        $this->crud->addColumn([
            'name' => 'type'
        ]);
    }

    public function setupCreateOperation() {
        $this->crud->addField([
            'name' => 'type'
        ]);
    }
}
