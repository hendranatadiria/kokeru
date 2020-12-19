<?php

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

use App\Http\Controllers\Admin\CleaningHistoryCrudController;

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('gedung', 'BuildingCrudController');
    Route::crud('cleaninghistory', 'CleaningHistoryCrudController');
    Route::crud('cleaningservice', 'CleaningServiceCrudController');
    Route::crud('responsibility', 'ResponsibilityCrudController');
    Route::crud('ruangan', 'RoomCrudController');
}); // this should be the absolute last line of this file
