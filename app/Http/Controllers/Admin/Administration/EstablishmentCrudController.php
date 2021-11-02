<?php


namespace App\Http\Controllers\Admin\Administration;

use App\Models\Administration\Establishment;
use App\Models\Administration\Governorate;
use App\Models\Administration\Sector;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Illuminate\Http\Request;

class EstablishmentCrudController extends CrudController
{
    use ListOperation, CreateOperation, DeleteOperation;

    public function setup()
    {
        $this->crud->setModel(Establishment::class);
        $this->crud->setRoute('/admin/establishment');
        $this->crud->setEntityNameStrings(__('names.administration.establishment'), __('names.administration.establishments'));
        $this->crud->enableExportButtons();
    }

    public function setupListOperation()
    {
        $this->crud->addColumns([
            [
                'name' => 'name',
                'label' => __('fields.establishment.name')
            ],
            [
                'name' => 'sector',
                'entity' => 'sector',
                'attribute' => 'name',
                'label' => __('names.administration.sector')
            ],
            [
                'name' => 'governorate',
                'entity' => 'governorate',
                'attribute' => 'name',
                'label' => __('names.administration.governorate')
            ]
        ]);
    }

    public function setupCreateOperation()
    {
        $this->crud->addFields([
            [
                'name' => 'name',
                'label' => __('fields.establishment.name'),
                'required' => true
            ],
            [
                'name' => 'is_municipality',
                'label' => __('municipality'),
                'type' => 'checkbox',
                'required' => false
            ],
            [
                'name' => 'sector',
                'entity' => 'sector',
                'type' => 'select2',
                'label' => __('names.administration.sector'),
                'required' => true
            ],
            [
                'name' => 'governorate',
                'entity' => 'governorate',
                'type' => 'select2',
                'label' => __('names.administration.governorate'),
                'required' => true
            ]
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $gov = Governorate::find($data['governorate']);
        $sector = Sector::find($data['sector']);

        $establishment = new Establishment([
            'name' => $data['name']
        ]);

        $establishment->governorate()->associate($gov);
        $establishment->sector()->associate($sector);
        $establishment->save();

        return redirect()->to($request->get('http_referrer', '/admin'));
    }
}
