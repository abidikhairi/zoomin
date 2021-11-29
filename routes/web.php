<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/report/{report}/observation', [\App\Http\Controllers\ReportController::class, 'observations']);
Route::get('/pages/stats/municipalities', [\App\Http\Controllers\Pages\MunicipalitiesStatsController::class, 'index'])
    ->name('stats.municipalities');
Route::get('/pages/observation/{governorate}', [\App\Http\Controllers\Pages\ObservationController::class, 'index'])
    ->name('page.observation');
Auth::routes(['verify' => true]);

Route::prefix('/citizen')->middleware(['auth', 'role:citizen'])->group(function (){
    Route::get('/', [\App\Http\Controllers\Citizen\HomeController::class, 'home']);
    Route::get('/claim/create', [\App\Http\Controllers\Citizen\ClaimController::class, 'create'])
        ->name('claim.create');
    Route::post('/claim/store', [\App\Http\Controllers\Citizen\ClaimController::class, 'store'])
        ->name('claim.store');
});

Route::prefix('/government-commissioner')->middleware(['auth', 'role:government-commissioner'])->group(function (){
    Route::get('/', function (){
        throw new Exception('Not Implemented: Government Commissioner Profile');
    });
});

Route::prefix('/magistrate')->middleware(['auth', 'role:magistrate'])->group(function (){
    Route::get('/', [\App\Http\Controllers\Magistrate\HomeController::class, 'home']);
    Route::get('/report', [\App\Http\Controllers\Magistrate\ReportController::class, 'index'])
        ->name('report.index');
    Route::get('/report/room', [\App\Http\Controllers\Magistrate\ReportController::class, 'room'])
        ->name('report.room.index');
    Route::get('/report/create', [\App\Http\Controllers\Magistrate\ReportController::class, 'create'])
        ->name('report.create');
    Route::post('/report/store/step1', [\App\Http\Controllers\Magistrate\ReportController::class, 'step1'])
        ->name('report.store.step1');
    Route::get('/report/observations/{report}/{observations}', [\App\Http\Controllers\Magistrate\ReportController::class, 'showObservationsForm'])
        ->name('report.observations.create');
    Route::post('/report/observation/store', [\App\Http\Controllers\Magistrate\ReportController::class, 'step2'])
        ->name('report.observation.store');
    Route::get('/claim', [\App\Http\Controllers\Magistrate\ClaimController::class, 'index'])
        ->name('report.claim.index');
    Route::get('/claim/{claim}', [\App\Http\Controllers\Magistrate\ClaimController::class, 'show'])
        ->name('report.claim.show');
    Route::get('/claim/respond/{claim}', [\App\Http\Controllers\Magistrate\ClaimController::class, 'showRespondForm'])
        ->name('report.claim.respond.form');
    Route::post('/claim/respond', [\App\Http\Controllers\Magistrate\ClaimController::class, 'respond'])
        ->name('report.claim.respond');
    Route::get('/report/comment/{report}', [\App\Http\Controllers\Magistrate\CommentController::class, 'show'])
        ->name('report.comment.show');
    Route::post('/report/comment/store', [\App\Http\Controllers\Magistrate\CommentController::class, 'store'])
        ->name('report.comment.store');
});

Route::prefix('/room-president')->middleware(['auth', 'role:room-president'])->group(function () {
    Route::get('/', [\App\Http\Controllers\RoomPresident\HomeController::class, 'home']);
    Route::get('/claim', [\App\Http\Controllers\RoomPresident\ClaimController::class, 'index'])
        ->name('room-president.claim.index');
    Route::get('/claim/archive', [\App\Http\Controllers\RoomPresident\ClaimController::class, 'archive'])
        ->name('room-president.claim.archive.index');
    Route::post('/claim/assign', [\App\Http\Controllers\RoomPresident\ClaimController::class, 'assign'])
        ->name('room-president.claim.assign');
    Route::get('/claim/response/{response}', [\App\Http\Controllers\RoomPresident\ResponseController::class, 'show'])
        ->name('room-president.claim.response.show');
    Route::get('/report', [\App\Http\Controllers\RoomPresident\ReportController::class, 'index'])
        ->name('room-president.report.index');
    Route::get('/report/comment/{report}', [\App\Http\Controllers\RoomPresident\ReportController::class, 'show'])
        ->name('room-president.report.comment.index');
    Route::get('/report/publish/{report}', [\App\Http\Controllers\RoomPresident\ReportController::class, 'publish'])
        ->name('room-president.report.publish');
});

Route::prefix('/first-president')->middleware(['auth', 'role:first-president'])->group(function () {
    Route::get('/', [\App\Http\Controllers\FirstPresident\HomeController::class, 'home']);
    Route::get('/room', [\App\Http\Controllers\FirstPresident\RoomController::class, 'index'])
        ->name('first-president.room.index');
    Route::get('/room/assign-president/{room}', [\App\Http\Controllers\FirstPresident\RoomController::class, 'assignPresidentForm'])
        ->name('first-president.room.assign');
    Route::post('/room/assign-president', [\App\Http\Controllers\FirstPresident\RoomController::class, 'assignPresident'])
        ->name('assign-president.save');
    Route::get('/room/president', [\App\Http\Controllers\FirstPresident\RoomController::class, 'roomPresidentForm'])
        ->name('first-president.room-president.form');
});
