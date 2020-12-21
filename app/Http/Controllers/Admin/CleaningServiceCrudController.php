<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CleaningServiceRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use App\Http\Requests\ItemRequest as ItemRequest;
use App\Models\CleaningService;
use App\Models\User;

/**
 * Class CleaningServiceCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CleaningServiceCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\CleaningService::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/cleaningservice');
        CRUD::setEntityNameStrings('Cleaning Service', 'Cleaning Service');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('name');
        CRUD::column('created_at');

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(CleaningServiceRequest::class);

        CRUD::field('name');
        CRUD::field('email');
        CRUD::field('password');

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number']));
         */
    }

    public function store(){
        $req = $this->crud->getRequest()->request->all();
        $cs = new CleaningService();
        $cs->name = $req['name'];
        $cs->save();
        $user = new User();
        $user->name = $req['name'];
        $user->email = $req['email'];
        $user->password = bcrypt($req['password']);
        $user->cleaning_services_id = $cs->id;
        $user->save();

        $user->assignRole('cleaning_service');

        return redirect('/admin/cleaningservice');

    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        CRUD::setValidation(CleaningServiceRequest::class);

        CRUD::field('name');
    }
}
