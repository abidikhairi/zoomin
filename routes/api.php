<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/room', [\App\Http\Controllers\Api\RoomController::class, 'index']);
Route::get('/claim/{governorate}', [App\Http\Controllers\Api\ClaimController::class, 'governorate']);
Route::get('/governorate', [\App\Http\Controllers\Api\GovernorateController::class, 'index']);
Route::get('/governorate/{governorate}', [\App\Http\Controllers\Api\GovernorateController::class, 'show']);
Route::get('/report', [\App\Http\Controllers\Api\ReportController::class, 'index']);
Route::get('/establishment/{sector}', [\App\Http\Controllers\Api\Administration\EstablishmentController::class, 'index']);

Route::get('/room-president/claim/{roomPresident}', [\App\Http\Controllers\Api\RoomPresidentController::class, 'claims']);
Route::get('/room-president/claim/citizen/priority/{roomPresident}', [\App\Http\Controllers\Api\RoomPresidentController::class, 'claimsOrderedByCitizenProfilePriority']);
Route::get('/room-president/claim/establishment/{roomPresident}', [\App\Http\Controllers\Api\RoomPresidentController::class, 'claimsOrderedByEstablishments']);
Route::get('/room-president/claim/sector/{roomPresident}', [\App\Http\Controllers\Api\RoomPresidentController::class, 'claimsOrderedBySectors']);
Route::post('/room-president/claim/assign', [\App\Http\Controllers\Api\RoomPresidentController::class, 'assignClaimToMagistrate']);
Route::post('/room-president/claim/archive', [\App\Http\Controllers\Api\RoomPresidentController::class, 'archiveClaim']);
Route::get('/room-president/claim/{roomPresident}/type', [\App\Http\Controllers\Api\RoomPresidentController::class, 'claimsForType']);

Route::get('/magistrate', [\App\Http\Controllers\Api\MagistrateController::class, 'index']);
Route::get('/magistrate/room/{room}', [\App\Http\Controllers\Api\MagistrateController::class, 'magistrates']);

Route::get('/report-type/{reportType}', [\App\Http\Controllers\Api\ReportTypeController::class, 'show']);
