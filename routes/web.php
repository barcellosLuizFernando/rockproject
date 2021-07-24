<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PeriodsheetController;
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

Route::get('/', [DashboardController::class, 'show'])->middleware('auth');
Route::get('/periodsheet', [PeriodsheetController::class, 'show'])->middleware('auth');
Route::get('/periodsheet/create', [PeriodsheetController::class, 'create'])->middleware('auth');
Route::get('/periodsheet/createmobile', [PeriodsheetController::class, 'createmobile'])->middleware('auth');
Route::get('/periodsheet/mobile', [PeriodsheetController::class, 'mobile'])->middleware('auth');
Route::get('/manageperiod', [PeriodsheetController::class, 'show'])->middleware('auth');
Route::get('/periodsheet/report', [PeriodsheetController::class, 'showperiods'])->middleware('auth');
Route::get('/periodsheet/report/{year}/{month}', [PeriodsheetController::class, 'showperiod'])->middleware('auth');
Route::get('/periodsheet/report/{year}/{month}/{id}', [PeriodsheetController::class, 'showperiodadm'])->middleware('auth');
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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
