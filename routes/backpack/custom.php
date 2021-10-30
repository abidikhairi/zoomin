<?php

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('role', 'RoleCrudController');
    Route::crud('permission', 'PermissionCrudController');
    Route::crud('team', 'TeamCrudController');

    Route::crud('sector', 'Administration\\SectorCrudController');
    Route::crud('governorate', 'Administration\\GovernorateCrudController');
    Route::crud('room', 'Administration\\RoomCrudController');
    Route::crud('establishment', 'Administration\\EstablishmentCrudController');
    Route::crud('report-type', 'Administration\\ReportTypeCrudController');

    Route::crud('magistrate', 'Actors\\MagistrateCrudController');
    Route::crud('room-president', 'Actors\\RoomPresidentCrudController');
    Route::crud('first-president', 'Actors\\FirstPresidentCrudController');
    Route::crud('government-commission', 'Actors\\GovernmentCommissionerCrudController');

    Route::crud('profile', 'Citizen\\ProfileCrudController');
    Route::crud('claim-type', 'Citizen\\ClaimTypeCrudController');
}); // this should be the absolute last line of this file
