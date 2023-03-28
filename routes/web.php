<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BreedController;
use App\Http\Controllers\CalfController;
use App\Http\Controllers\CattleController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HealthStatusController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\LedgerController;
use App\Http\Controllers\MedicationController;
use App\Http\Controllers\MilkController;
use App\Http\Controllers\MilkSaleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoutineController;
use App\Http\Controllers\StallController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UsageController;
use App\Http\Controllers\UserController;
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

//Auth Routes
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'register'])->name('register'); 
Route::get('/', [HomeController::class, 'index'])->name('dashboard')->middleware('auth'); 
Route::post('custom-login', [AuthController::class, 'customLogin'])->name('login.custom'); 
Route::post('custom-registration', [AuthController::class, 'customRegistration'])->name('register.custom'); 
Route::get('signout', [AuthController::class, 'signOut'])->name('signout');

Route::get('/User-Profile', [ProfileController::class, 'index'])->name('user-profile');
Route::post('/Update-Profile', [ProfileController::class, 'update'])->name('profile.update');

Route::group(['middleware' => ['auth','role:owner|manager',]], function() {
    Route::get('/Users',[UserController::class, 'index'])->name('all.users');
    Route::get('/list-users',[UserController::class, 'anyData'])->name('list-users');
    Route::resource('user', UserController::class);
    Route::get('/Stalls', [StallController::class, 'index'])->name('stalls');
    Route::get('/list-stalls', [StallController::class, 'anyData'])->name('list-stalls');
    Route::resource('stall', StallController::class);
    Route::get('/Breeds', [BreedController::class, 'index'])->name('breeds');
    Route::get('/list-breeds', [BreedController::class, 'anyData'])->name('list-breeds');
    Route::resource('breed', BreedController::class);
    Route::get('/Cattle', [CattleController::class, 'index'])->name('cattle');
    Route::get('/list-cattle', [CattleController::class, 'anyData'])->name('list-cattle');
    Route::get('/Cattle-{id}', [CattleController::class, 'edit'])->name('cattle.view');
    Route::resource('cattle', CattleController::class);
    Route::get('/Calves', [CalfController::class, 'index'])->name('calf');
    Route::get('/list-calves', [CalfController::class, 'anyData'])->name('list-calves');
    Route::get('/Calf-{id}', [CalfController::class, 'edit'])->name('calf.view');
    Route::resource('calf', CalfController::class);
    Route::get('/Milk-Production', [MilkController::class, 'index'])->name('milks');
    Route::get('/list-milk', [MilkController::class, 'anyData'])->name('list-milk');
    Route::resource('milk', MilkController::class);
    Route::get('/Milk-Sales', [MilkSaleController::class, 'index'])->name('milk-sales');
    Route::get('/New-Milk-Sale', [MilkSaleController::class, 'saleMilk'])->name('sale.milk.new');
    Route::post('Milk-Sale-New', [MilkSaleController::class, 'store'])->name('sale.milk.create');
    Route::get('/list-milk-sales', [MilkSaleController::class, 'anyData'])->name('list-milk-sales');
    Route::get('/Routines', [RoutineController::class, 'index'])->name('routines');
    Route::get('/list-routines', [RoutineController::class, 'anyData'])->name('list-routines');
    Route::resource('routine', RoutineController::class);
    Route::get('/HealthStatus', [HealthStatusController::class, 'index'])->name('health-status');
    Route::get('/list-status', [HealthStatusController::class, 'anyData'])->name('list-status');
    Route::resource('status', HealthStatusController::class);
    Route::get('/Medications', [MedicationController::class, 'index'])->name('medications');
    Route::get('/New-Medication', [MedicationController::class, 'newMedication'])->name('medication.new');
    Route::post('/Medication-Create', [MedicationController::class, 'store'])->name('medication.create');
    Route::get('/list-medications', [MedicationController::class, 'anyData'])->name('list-medications');
    Route::get('/Inventories',[InventoryController::class, 'index'])->name('inventories');
    Route::get('/New-Inventory',[InventoryController::class, 'newInventory'])->name('inventory.new');
    Route::post('/Inventory-Create',[InventoryController::class, 'store'])->name('inventory.create');
    Route::get('/list-inventories', [InventoryController::class, 'anyData'])->name('list-inventories');
    Route::get('/Stocks',[StockController::class, 'index'])->name('stocks');
    Route::get('/Usages', [UsageController::class, 'index'])->name('usages');
    Route::get('/New-Usage', [UsageController::class, 'newUsage'])->name('usage.new');
    Route::post('/Usage-Create', [UsageController::class, 'store'])->name('usage.create');
    Route::get('/list-usages', [UsageController::class, 'anyData'])->name('list-usages');
    Route::get('/Inventory-Usage-{id}', [UsageController::class, 'edit'])->name('usage.view');
    Route::get('/HR-Employees', [EmployeeController::class, 'index'])->name('employees');
    Route::get('/list-employees', [EmployeeController::class, 'anyData'])->name('list-employees');
    Route::get('/Hr-employee-{id}', [EmployeeController::class, 'edit'])->name('employee.view');
    Route::resource('employee', EmployeeController::class);
    Route::get('/HR-Leaves', [LeaveController::class, 'index'])->name('leaves');
    Route::get('/list-leaves', [LeaveController::class, 'anyData'])->name('list-leaves');
    Route::resource('leave', LeaveController::class);
    Route::get('/Ledgers', [LedgerController::class, 'index'])->name('ledgers');
    Route::get('/list-ledgers', [LedgerController::class, 'anyData'])->name('list-ledgers');
    Route::get('/Accounts-ledger-{id}', [LedgerController::class, 'edit'])->name('ledger.view');
    Route::resource('ledger', LedgerController::class);
    Route::get('/Tags', [TagController::class, 'index'])->name('tags');
    Route::get('/list-tags', [TagController::class, 'anyData'])->name('list-tags');
    Route::resource('tag', TagController::class);
});

