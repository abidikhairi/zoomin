<?php


namespace App\Http\Controllers\Admin\Administration;

use App\Models\Administration\Governorate;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;

class GovernorateCrudController extends CrudController
{
    use ListOperation;

    public function setup()
    {
        $this->crud->setModel(Governorate::class);
        $this->crud->setRoute('/admin/governorate');
        $this->crud->setEntityNameStrings(__('names.administration.governorate'), __('names.administration.governorates'));
        $this->crud->enableExportButtons();
    }

    public function setupListOperation()
    {
        $this->crud->addColumns([
            [
                'name' => 'name',
                'label' => __('fields.governorate.name')
            ],
            [
                'name' => 'room',
                'entity' => 'room',
                'attribute' => 'name',
                'label' => __('names.administration.room')
            ],
            [
                'name' => 'establishments',
                'entity' => 'establishments',
                'type' => 'relationship_count',
                'label' => __('names.administration.establishments')
            ]
        ]);
    }
}
