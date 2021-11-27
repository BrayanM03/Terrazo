<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\EquiptmentController;
use App\Http\Controllers\LaborController;
use App\Http\Controllers\OtherExpensisController; 

use App\Http\Controllers\ContractOrderController; 

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
    return view('auth.login');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dash', function () {
    return view('dash.index');
})->name('dash');


//Route::get('dash/material', [MaterialController::class, 'index']);
//Route::resource('dash/categories/materials', MaterialController::class);
Route::resource('dash/categories/materials', 'App\Http\Controllers\MaterialController');
Route::post('dash/categories/materials/created', [MaterialController::class, 'store']);
Route::get('datatable/materials', 'App\Http\Controllers\DatatableController@material')->name('datatable.material');

Route::resource('dash/categories/equiptments', 'App\Http\Controllers\EquiptmentController');
Route::post('dash/categories/equiptments/created', [EquiptmentController::class, 'store']);
Route::get('datatable/equiptments', 'App\Http\Controllers\DatatableController@equiptment')->name('datatable.equiptment');


Route::resource('dash/categories/labors', 'App\Http\Controllers\LaborController');
Route::post('dash/categories/labors/created', [LaborController::class, 'store']);
Route::get('datatable/labors', 'App\Http\Controllers\DatatableController@labor')->name('datatable.labor'); //'DatatableController@labor'

Route::resource('dash/categories/other_expenses', 'App\Http\Controllers\OtherExpensisController');
Route::post('dash/categories/other_expenses/created', [OtherExpensisController::class, 'store']);
Route::get('datatable/other_expenses', 'App\Http\Controllers\DatatableController@other_expenses')->name('datatable.other_expenses');

//Clientes
Route::resource('dash/persons/customers', 'App\Http\Controllers\CustomerController');
Route::post('dash/persons/customers/created', 'App\Http\Controllers\CustomerController@store' /* [CustomerController::class, 'store'] */);
Route::get('datatable/customers', 'App\Http\Controllers\DatatableController@customer')->name('datatable.customer');

//Rutas del new Order
Route::get('dash/orders','App\Http\Controllers\NewOrderController@index');
Route::resource('dash/orders/contract_order','App\Http\Controllers\ContractOrderController');
Route::post('/getCustomers', [ContractOrderController::class, 'getCustomers'])->name('getCustomers');

//Rutas select2 Contract Concepts
Route::post('/getMaterials', [ContractOrderController::class, 'getMaterials'])->name('getMaterials');
Route::post('/getEquiptments', [ContractOrderController::class, 'getEquiptments'])->name('getEquiptments');
Route::post('/getLabors', [ContractOrderController::class, 'getLabors'])->name('getLabors');
Route::post('/getOtherExpenses', [ContractOrderController::class, 'getOtherExpenses'])->name('getOtherExpenses');

//Rutas para agregar datos a las tablas tmp
Route::post('/insertdata', [ContractOrderController::class, 'store'])->name('insertdata');


Route::get('datatable/material_tmp', 'App\Http\Controllers\DatatableController@getMaterialTemp')->name('datatable.material_tmp');

