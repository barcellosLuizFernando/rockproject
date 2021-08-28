<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PeriodsheetController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\SeederController;

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

Route::get('/', [DashboardController::class, 'show'])->middleware('auth');
Route::get('/periodsheet', [PeriodsheetController::class, 'show'])->middleware('auth');
Route::get('/periodsheet/report', [PeriodsheetController::class, 'showperiods'])->middleware('auth');
Route::get('/periodsheet/report/{year}/{month}', [PeriodsheetController::class, 'showperiod'])->middleware('auth');
Route::get('/periodsheet/report/{year}/{month}/{id}', [PeriodsheetController::class, 'showperiodadm'])->middleware('auth');
Route::post('/periodsheet/adjust/Novo', [PeriodsheetController::class, 'createadjust'])->middleware('auth');
Route::put('/periodsheet/adjust/{id}', [PeriodsheetController::class, 'storeadjust'])->middleware('auth');
Route::get('/periodsheet/adjust/{id}/{year}/{month}/{day}', [PeriodsheetController::class, 'showadjust'])->middleware('auth');
Route::get('/periodsheet/create', [PeriodsheetController::class, 'create'])->middleware('auth');
Route::get('/periodsheet/createmobile', [PeriodsheetController::class, 'createmobile'])->middleware('auth');
Route::get('/periodsheet/mobile', [PeriodsheetController::class, 'mobile'])->middleware('auth');
Route::get('/periodsheet/{id}', [PeriodsheetController::class, 'showoneadjust'])->middleware('auth');
Route::delete('/periodsheet/{id}', [PeriodsheetController::class, 'destroy'])->middleware('auth');
Route::get('/manageperiod', [PeriodsheetController::class, 'shownewadjust'])->middleware('auth');
Route::get('/mailable', [PeriodsheetController::class, 'mailable'])->middleware('auth');
Route::get('/dashboard_old', function(){
    return view('dashboard_old');
})->middleware('auth');

Route::get('/employee', [EmployeeController::class, 'index'])->middleware('auth');
Route::get('/employee/create', [EmployeeController::class, 'create'])->middleware('auth');
Route::get('/employee/{id}', [EmployeeController::class, 'show'])->middleware('auth');
Route::post('/employee/create', [EmployeeController::class, 'store'])->middleware('auth');
Route::delete('/employee/{id}', [EmployeeController::class, 'destroy'])->middleware('auth');
Route::put('/employee/{id}', [EmployeeController::class, 'update'])->middleware('auth');

Route::get('/configs', [ConfigController::class, 'index'])->middleware('auth');
Route::put('/configs', [ConfigController::class, 'update']);
Route::get('/configs/checkip', [ConfigController::class, 'checkip']);

Route::get('/seed/country', [SeederController::class, 'seedcountry']);
Route::get('/seed/state', [SeederController::class, 'seedstate']);
Route::get('/seed/city', [SeederController::class, 'seedcity']);
Route::get('/seed/cnae', [SeederController::class, 'seedcnae']);
Route::get('/seed/cfps_cst', [SeederController::class, 'seedcfpscst']);



Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
