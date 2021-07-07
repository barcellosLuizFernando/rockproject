<?php

use App\Http\Controllers\DashboardController;
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
Route::get('/manageperiod', [PeriodsheetController::class, 'show'])->middleware('auth');
Route::get('/periodreport', [PeriodsheetController::class, 'show'])->middleware('auth');
Route::get('/mailable', [PeriodsheetController::class, 'mailable'])->middleware('auth');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard', ['user' => auth()->user()]);
})->name('dashboard');
