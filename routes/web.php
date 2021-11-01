<?php

use App\Charts\SalesChart;
use App\Http\Controllers\Auth\Users;
use App\Http\Controllers\BankAccountsController;
use App\Http\Controllers\BanksController;
use App\Http\Controllers\BankStatementController;
use App\Http\Controllers\CourseclassesController;
use App\Http\Controllers\ClasslocalsController;
use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PeriodsheetController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\FinancePlanController;
use App\Http\Controllers\PaymentMovesController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\PeopleController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\ReceivableController;
use App\Http\Controllers\ReceivableMovesController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SeederController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TreasuryController;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;

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
Route::get('/periodsheet/report/pdf/{year}/{month}/{id}', [PeriodsheetController::class, 'getPDF'])->middleware('auth');
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

Route::get('/dashboard_old', function () {
    return view('dashboard_old');
})->middleware('auth');

Route::get('registers', [RegisterController::class, 'index'])->middleware('auth');

Route::get('registers/classcourses', [CourseclassesController::class, 'index'])->middleware('auth');
Route::get('registers/classcourses/create', [CourseclassesController::class, 'create'])->middleware('auth');
Route::post('registers/classcourses/create', [CourseclassesController::class, 'store'])->middleware('auth');
Route::get('registers/classcourses/{id}', [CourseclassesController::class, 'show'])->middleware('auth');
Route::put('registers/classcourses/{id}', [CourseclassesController::class, 'update'])->middleware('auth');
Route::delete('registers/classcourses/{id}', [CourseclassesController::class, 'destroy'])->middleware('auth');

Route::get('registers/classlocals', [ClasslocalsController::class, 'index'])->middleware('auth');
Route::get('registers/classlocals/create', [ClasslocalsController::class, 'create'])->middleware('auth');
Route::get('registers/classlocals/{id}', [ClasslocalsController::class, 'show'])->middleware('auth');
Route::put('registers/classlocals/{id}', [ClasslocalsController::class, 'update'])->middleware('auth');
Route::delete('registers/classlocals/{id}', [ClasslocalsController::class, 'destroy'])->middleware('auth');
Route::post('registers/classlocals/create', [ClasslocalsController::class, 'store'])->middleware('auth');

Route::get('registers/courses', [CoursesController::class, 'index'])->middleware('auth');
Route::get('registers/courses/create', [CoursesController::class, 'create'])->middleware('auth');
Route::get('registers/courses/{id}', [CoursesController::class, 'show'])->middleware('auth');
Route::put('registers/courses/{id}', [CoursesController::class, 'update'])->middleware('auth');
Route::delete('registers/courses/{id}', [CoursesController::class, 'destroy'])->middleware('auth');
Route::post('registers/courses/create', [CoursesController::class, 'store'])->middleware('auth');

Route::get('/registers/products', [ProductsController::class, 'index'])->middleware('auth');
Route::get('/registers/products/create', [ProductsController::class, 'create'])->middleware('auth');
Route::post('/registers/products/create', [ProductsController::class, 'store'])->middleware('auth');
Route::get('/registers/products/{id}', [ProductsController::class, 'show'])->middleware('auth');
Route::put('/registers/products/{id}', [ProductsController::class, 'update'])->middleware('auth');
Route::delete('/registers/products/{id}', [ProductsController::class, 'destroy'])->middleware('auth');

Route::get('/schedule', [ScheduleController::class, 'index'])->middleware('auth');
Route::get('/schedule/getSchedule', [ScheduleController::class, 'getSchedule'])->middleware('auth');
Route::post('/schedule/setSchedule', [ScheduleController::class, 'setSchedule'])->middleware('auth');

Route::get('/registers/users', [ScheduleController::class, 'index'])->middleware('auth');

Route::get('/registers/companies', [CompaniesController::class, 'index'])->middleware('auth');
Route::get('/registers/companies/create', [CompaniesController::class, 'create'])->middleware('auth');
Route::post('/registers/companies/create', [CompaniesController::class, 'store'])->middleware('auth');
Route::get('/registers/companies/{id}', [CompaniesController::class, 'show'])->middleware('auth');
Route::put('/registers/companies/{id}', [CompaniesController::class, 'update'])->middleware('auth');
Route::delete('/registers/companies/{id}', [CompaniesController::class, 'destroy'])->middleware('auth');

Route::get('/registers/employee', [EmployeeController::class, 'index'])->middleware('auth');
Route::get('/registers/employee/create', [EmployeeController::class, 'create'])->middleware('auth');
Route::get('/registers/employee/{id}', [EmployeeController::class, 'show'])->middleware('auth');
Route::post('/registers/employee/create', [EmployeeController::class, 'store'])->middleware('auth');
Route::delete('/registers/employee/{id}', [EmployeeController::class, 'destroy'])->middleware('auth');
Route::put('/registers/employee/{id}', [EmployeeController::class, 'update'])->middleware('auth');

Route::get('/registers/transactions', [TransactionController::class, 'index'])->middleware('auth');
Route::get('/registers/transactions/create', [TransactionController::class, 'create'])->middleware('auth');
Route::post('/registers/transactions/create', [TransactionController::class, 'store'])->middleware('auth');
Route::get('/registers/transactions/{id}', [TransactionController::class, 'show'])->middleware('auth');
Route::put('/registers/transactions/{id}', [TransactionController::class, 'update'])->middleware('auth');
Route::delete('/registers/transactions/{id}', [TransactionController::class, 'destroy'])->middleware('auth');

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

Route::get('/finance/receivables', [ReceivableController::class, 'index'])->middleware('auth');
Route::get('/finance/receivables/create', [ReceivableController::class, 'create'])->middleware('auth');
Route::post('/finance/receivables/create', [ReceivableController::class, 'store'])->middleware('auth');
Route::get('/finance/receivables/{id}', [ReceivableController::class, 'show'])->middleware('auth');
Route::put('/finance/receivables/{id}', [ReceivableController::class, 'update'])->middleware('auth');
Route::delete('/finance/receivables/{id}', [ReceivableController::class, 'destroy'])->middleware('auth');
Route::post('/finance/receivables/paybills', [ReceivableMovesController::class, 'store'])->middleware('auth');

Route::get('/finance/sales', [SalesController::class, 'index'])->middleware('auth');
Route::put('/finance/sales/{id}', [SalesController::class, 'update'])->middleware('auth');
Route::get('/finance/sales/avgticket', [SalesController::class, 'dbavgticket'])->middleware('auth');
Route::get('/finance/sales/report', [SalesController::class, 'show'])->middleware('auth');
Route::get('/finance/sales/report/pdf', [SalesController::class, 'getPDF'])->middleware('auth');
Route::post('/finance/sales/importxml', [SalesController::class, 'create'])->middleware('auth');

Route::get('/finance/treasury/bankstatement', [BankStatementController::class, 'index'])->middleware('auth');
Route::post('/finance/treasury/bankstatement', [BankStatementController::class, 'store'])->middleware('auth');
Route::get('/finance/treasury', [TreasuryController::class, 'index'])->middleware('auth');
Route::get('/finance/treasury/{id}', [TreasuryController::class, 'show'])->middleware('auth');
Route::get('/finance/treasury/create/{id}', [TreasuryController::class, 'create'])->middleware('auth');
Route::post('/finance/treasury/create/{id}', [TreasuryController::class, 'store'])->middleware('auth');
Route::delete('/finance/treasury/{id}', [TreasuryController::class, 'destroy'])->middleware('auth');


Route::get('/finance/payments', [PaymentsController::class, 'index'])->middleware('auth');
Route::get('/finance/payments/create', [PaymentsController::class, 'create'])->middleware('auth');
Route::get('/finance/payments/{id}', [PaymentsController::class, 'show'])->middleware('auth');
Route::put('/finance/payments/{id}', [PaymentsController::class, 'update'])->middleware('auth');
Route::delete('/finance/payments/{id}', [PaymentsController::class, 'destroy'])->middleware('auth');
Route::post('/finance/payments/create', [PaymentsController::class, 'store'])->middleware('auth');

Route::post('/finance/payments/paybills', [PaymentMovesController::class, 'store'])->middleware('auth');

Route::get('/configs/backups/dump', [ConfigController::class, 'dumpbackup'])->middleware('auth');
Route::delete('/configs/backups/{id}', [ConfigController::class, 'destroybackup'])->middleware('auth');
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
    
    return redirect('/');
    
    //return view('dashboard');
})->name('dashboard');
