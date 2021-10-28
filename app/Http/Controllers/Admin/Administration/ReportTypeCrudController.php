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

    /**
     * @throws \Exception
     */
    public function setup()
    {
        $this->crud->setModel(ReportType::class);
        $this->crud->setRoute('admin/report-type');
        $this->crud->setEntityNameStrings(__('report-type'), __('report-type'));
    }

    public function setupListOperation() {
        $this->crud->addColumns([
            [
                'name' => 'type'
            ],
            [
                'name' => 'has_observations',
            ],
            [
                'name' => 'has_sector'
            ],
            [
                'name' => 'has_establishment'
            ]
        ]);
    }

    public function setupCreateOperation() {
        $this->crud->addFields([
            [
                'name' => 'type'
            ],
            [
                'name' => 'has_establishment',
                'type' => 'checkbox'
            ],
            [
                'name' => 'has_sector',
                'type' => 'checkbox'
            ],
            [
                'name' => 'has_observations',
                'type' => 'checkbox'
            ],
            [
                'name' => 'teams',
                'type' => 'select2_multiple',
                'entity' => 'teams'
            ]
        ]);
    }
}
