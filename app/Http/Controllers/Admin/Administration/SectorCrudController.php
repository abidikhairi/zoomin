<?php


namespace App\Http\Controllers\Admin\Administration;


use App\Models\Administration\Sector;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
use Illuminate\Http\Request;

class SectorCrudController extends CrudController
{
    use ListOperation, CreateOperation, DeleteOperation;

    public function setup()
    {
        $this->crud->setModel(Sector::class);
        $this->crud->setRoute('/admin/sector');
        $this->crud->setEntityNameStrings(__('names.administration.sector'), __('names.administration.sectors'));
        $this->crud->enableExportButtons();
    }

    public function setupListOperation()
    {
        $this->crud->addColumns([
            [
                'name' => 'name',
                'label' => __('fields.sector.name')
            ],
            [
                'name' => 'establishments',
                'entity' => 'establishments',
                'type' => 'relationship_count',
                'label' => __('names.administration.establishments')
            ]
        ]);
    }

    public function setupCreateOperation()
    {
        $this->crud->addFields([
            [
                'name' => 'name',
                'label' => __('fields.sector.name')
            ]
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:5|max:255'
        ]);

        Sector::create([
            'name' => $request->name
        ]);

        return redirect()->to($request->get('http_referrer', '/admin'));
    }

    public function setupUpdateOperation()
    {
        $this->crud->addField([
            'name' => 'establishments',
            'entity' => 'establishments',
            'type' => 'select2_multiple',
            'label' => __('names.administration.establishments')
        ]);
    }

}
