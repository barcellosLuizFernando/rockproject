<?php

use App\Http\Controllers\BankAccountsController;
use App\Http\Controllers\BanksController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PeriodsheetController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\FinancePlanController;
use App\Http\Controllers\PaymentMovesController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\PeopleController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\RegisterController;
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

Route::get('registers', [RegisterController::class, 'index'])->middleware('auth');

Route::get('registers/employee', [EmployeeController::class, 'index'])->middleware('auth');
Route::get('registers/employee/create', [EmployeeController::class, 'create'])->middleware('auth');
Route::get('registers/employee/{id}', [EmployeeController::class, 'show'])->middleware('auth');
Route::post('registers/employee/create', [EmployeeController::class, 'store'])->middleware('auth');
Route::delete('registers/employee/{id}', [EmployeeController::class, 'destroy'])->middleware('auth');
Route::put('registers/employee/{id}', [EmployeeController::class, 'update'])->middleware('auth');

Route::get('/finance', [FinanceController::class, 'index'])->middleware('auth');
Route::get('/finance/banks', [BanksController::class, 'index'])->middleware('auth');
Route::get('/finance/banks/create', [BanksController::class, 'create'])->middleware('auth');
Route::post('/finance/banks/create', [BanksController::class, 'store'])->middleware('auth');
Route::put('/finance/banks/{id}', [BanksController::class, 'update'])->middleware('auth');
Route::delete('/finance/banks/{id}', [BanksController::class, 'destroy'])->middleware('auth');
Route::get('/finance/banks/{id}', [BanksController::class, 'show'])->middleware('auth');

Route::get('/finance/bankaccounts', [BankAccountsController::class, 'index'])->middleware('auth');
Route::get('/finance/bankaccounts/create', [BankAccountsController::class, 'create'])->middleware('auth');
Route::get('/finance/bankaccounts/{id}', [BankAccountsController::class, 'show'])->middleware('auth');
Route::put('/finance/bankaccounts/{id}', [BankAccountsController::class, 'update'])->middleware('auth');
Route::delete('/finance/bankaccounts/{id}', [BankAccountsController::class, 'destroy'])->middleware('auth');
Route::post('/finance/bankaccounts/create', [BankAccountsController::class, 'store'])->middleware('auth');

Route::get('/finance/financeplan', [FinancePlanController::class, 'index'])->middleware('auth');
Route::get('/finance/financeplan/create', [FinancePlanController::class, 'create'])->middleware('auth');
Route::post('/finance/financeplan/create', [FinancePlanController::class, 'store'])->middleware('auth');
Route::get('/finance/financeplan/{id}', [FinancePlanController::class, 'show'])->middleware('auth');
Route::put('/finance/financeplan/{id}', [FinancePlanController::class, 'update'])->middleware('auth');

Route::get('/finance/people', [PeopleController::class, 'index'])->middleware('auth');
Route::get('/finance/people/create', [PeopleController::class, 'create'])->middleware('auth');
Route::post('/finance/people/create', [PeopleController::class, 'store'])->middleware('auth');
Route::get('/finance/people/{id}', [PeopleController::class, 'show'])->middleware('auth');
Route::put('/finance/people/{id}', [PeopleController::class, 'update'])->middleware('auth');
Route::delete('/finance/people/{id}', [PeopleController::class, 'destroy'])->middleware('auth');

Route::get('/finance/purchases', [PurchaseController::class, 'index'])->middleware('auth');
Route::get('/finance/purchases/create', [PurchaseController::class, 'create'])->middleware('auth');
Route::get('/finance/purchases/{id}', [PurchaseController::class, 'show'])->middleware('auth');
Route::put('/finance/purchases/{id}', [PurchaseController::class, 'update'])->middleware('auth');
Route::delete('/finance/purchases/{id}', [PurchaseController::class, 'destroy'])->middleware('auth');
Route::post('/finance/purchases/create', [PurchaseController::class, 'store'])->middleware('auth');

Route::get('/finance/payments', [PaymentsController::class, 'index'])->middleware('auth');

Route::get('/finance/payments/paybills', [PaymentMovesController::class, 'index'])->middleware('auth');

Route::get('/configs', [ConfigController::class, 'index'])->middleware('auth');
Route::put('/configs', [ConfigController::class, 'update']);
Route::get('/configs/checkip', [ConfigController::class, 'checkip']);

Route::get('/seed/country', [SeederController::class, 'seedcountry']);
Route::get('/seed/state', [SeederController::class, 'seedstate']);
Route::get('/seed/city', [SeederController::class, 'seedcity']);
Route::get('/seed/cnae', [SeederController::class, 'seedcnae']);
Route::get('/seed/cfps_cst', [SeederController::class, 'seedcfpscst']);
Route::get('/seed/transaction', [SeederController::class, 'seedtransaction']);



Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
