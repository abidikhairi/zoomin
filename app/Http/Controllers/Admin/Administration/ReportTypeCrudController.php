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
        $this->crud->setEntityNameStrings(('نوع التقرير'), ('أنواع التقارير'));
    }

    public function setupListOperation() {
        $this->crud->addColumns([
            [
                'name' => 'type',
                'label' => 'نوع التقرير'
            ],
            [
                'name' => 'is_public',
                'label' => 'تقرير عمومي'
            ],
            [
                'name' => 'has_observations',
                'label' => 'ملاحظات'
            ],
            [
                'name' => 'has_sector',
                'label' => 'قطاع'
            ],
            [
                'name' => 'has_establishment',
                'label' => 'مؤسسة'
            ]
        ]);
    }

    public function setupCreateOperation() {
        $this->crud->addFields([
            [
                'name' => 'type',
                'label' => 'نوع التقرير'
            ],
            [
                'name' => 'is_public',
                'type' => 'checkbox',
                'label' => 'تقرير عمومي'
            ],
            [
                'name' => 'has_establishment',
                'type' => 'checkbox',
                'label' => 'مؤسسة'
            ],
            [
                'name' => 'has_sector',
                'type' => 'checkbox',
                'label' => 'قطاع'
            ],
            [
                'name' => 'has_observations',
                'type' => 'checkbox',
                'label' => 'ملاحظات'
            ],
            [
                'name' => 'teams',
                'type' => 'select2_multiple',
                'entity' => 'teams',
                'label' => 'المجموعات'
            ]
        ]);
    }
}
