<?php


namespace App\Http\Controllers\Admin\Administration;


use App\Models\Administration\Governorate;
use App\Models\Administration\Room;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
use Illuminate\Http\Request;

class RoomCrudController extends CrudController
{
    use ListOperation, UpdateOperation, CreateOperation, DeleteOperation;

    /**
     * @throws \Exception
     */
    public function setup()
    {
        $this->crud->setModel(Room::class);
        $this->crud->setRoute('/admin/room');
        $this->crud->setEntityNameStrings(__('names.administration.room'), __('names.administration.rooms'));
        $this->crud->enableExportButtons();
    }

    public function setupListOperation()
    {
        $this->crud->addColumns([
            [
                'name' => 'name',
                'label' => __('fields.room.name')
            ],
            [
                'name' => 'magistrates',
                'entity' => 'magistrates',
                'type' => 'relationship_count',
                'label' => __('names.administration.magistrates')
            ],
            [
                'name' => 'governorates',
                'entity' => 'governorates',
                'type' => 'relationship_count',
                'label' => __('names.administration.governorates')
            ]
        ]);
    }

    public function setupCreateOperation()
    {
        $this->crud->addFields([
            [
                'name' => 'name',
                'label' => __('fields.room.name')
            ],
            [
                'name' => 'governorates',
                'entity' => 'governorates',
                'type' => 'select2_multiple',
                'label' => __('names.administration.governorates')
            ]
        ]);
    }

    public function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'governorates' => 'required',
            'id' => 'required'
        ]);
        $data = $request->all();

        $room = Room::find($data['id']);

        $room->update([
            'name' => $request->name
        ]);

        $govs = collect($data['governorates'])->map(function ($idx){ return Governorate::find($idx); });
        $room->governorates()->saveMany($govs);

        return redirect()->to($request->get('http_referrer', '/admin'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|unique:rooms',
            'governorates' => 'required'
        ]);

        $data = $request->all();

        $room = new Room([
            'name' => $request->name
        ]);

        $govs = collect($data['governorates'])->map(function ($idx){ return Governorate::find($idx); });

        $room->save();
        $room->governorates()->saveMany($govs);

        return redirect()->to($request->get('http_referrer', '/admin'));
    }
}
