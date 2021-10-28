<?php

namespace App\Http\Controllers\Admin;

use App\Models\Team;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;

class TeamCrudController extends CrudController
{

    use ListOperation, DeleteOperation, CreateOperation;

    /**
     * @throws \Exception
     */
    public function setup()
    {
        $this->crud->setModel(Team::class);
        $this->crud->setRoute('admin/team');
        $this->crud->setEntityNameStrings(__('group'), __('groups'));
    }

    public function setupListOperation()
    {
        $this->crud->addColumn([
            'name' => 'name'
        ]);
    }

    public function setupCreateOperation()
    {
        $this->crud->addField([
            'name' => 'name'
        ]);
    }

    /**
    public function setupUpdateOperation()
    {
        $this->crud->addField([
            'label' => 'users',
            'name' => 'users',
            'entity' => 'users',
            'type' => 'select2_multiple',
            'attribute' => 'email_role'
        ]);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|exists:teams,id',
            'users' => 'required'
        ]);
        $data = $request->all();

        $team = Team::query()->find($data['id'])->firstOrFail();
        $users = collect($data['users'])->values()->toArray();
        $team->users()->sync($users);

        return redirect()->to($request->get('http_referrer', '/admin'));

    }*/

}
