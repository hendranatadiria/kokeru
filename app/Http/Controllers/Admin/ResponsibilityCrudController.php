<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ResponsibilityRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ResponsibilityCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ResponsibilityCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Responsibility::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/responsibility');
        CRUD::setEntityNameStrings('Pembagian Ruangan', 'Pembagian Ruangan');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::addColumn([
            'name'         => 'cleaningService', // name of relationship method in the model
            'type'         => 'relationship',
            'label'        => 'Nama Cleaning Service', // Table column heading
        ]);
        CRUD::addColumn([
            'name'         => 'room', // name of relationship method in the model
            'type'         => 'relationship',
            'label'        => 'Ruangan', // Table column heading
        ]);
        CRUD::addColumn([   // Date
            'name'  => 'assigned_from',
            'label' => 'Mulai tanggal',
            'type'  => 'date'
        ],);
        CRUD::column('assigned_from');
        CRUD::addColumn([   // Date
            'name'  => 'assigned_to',
            'label' => 'Sampai tanggal',
            'type'  => 'date'
        ],);

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
        CRUD::setValidation(ResponsibilityRequest::class);

        CRUD::field('cleaning_service_id');
        CRUD::field('room_id');
        CRUD::field('assigned_from');
        CRUD::field('assigned_to');

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number']));
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
