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
Route::get('/governorate/{governorate}/establishment', [\App\Http\Controllers\Api\GovernorateController::class, 'establishments']);
Route::get('/report', [\App\Http\Controllers\Api\ReportController::class, 'index']);
Route::get('/report/sector/{sector}', [\App\Http\Controllers\Api\ReportController::class, 'reportBySector']);
Route::get('/report/sector/{sector}/{governorate}', [\App\Http\Controllers\Api\ReportController::class, 'reportByGovernorateAndSector']);
Route::get('/report/governorate/{governorate}', [\App\Http\Controllers\Api\ReportController::class, 'reportByGovernorate']);
Route::get('/report/{governorate}/{establishment}', [\App\Http\Controllers\Api\ReportController::class, 'reportByGovernorateEstablishment']);
Route::get('/establishment/governorate/{governorate}/{sector}', [\App\Http\Controllers\Api\Administration\EstablishmentController::class, 'index']);
Route::get('/establishment/sector/{sector}', [\App\Http\Controllers\Api\Administration\EstablishmentController::class, 'establishmentsBySector']);
Route::get('/establishment/show/{establishment}', [\App\Http\Controllers\Api\Administration\EstablishmentController::class, 'show']);
Route::get('/sector', [\App\Http\Controllers\Api\SectorController::class, 'all']);
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

Route::get('/observation/rank', [\App\Http\Controllers\Api\ObservationController::class, 'rankMunicipalities']);
