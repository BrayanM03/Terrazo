<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\EquiptmentController;
use App\Http\Controllers\LaborController;
use App\Http\Controllers\OtherExpensisController; 

use App\Http\Controllers\ContractOrderController; 
use App\Http\Controllers\OrdersController; 
use App\Http\Controllers\PendingOrdersController; 
use App\Http\Controllers\ChangeOrderController; 
use App\Http\Controllers\OrderStatusController;
use App\Http\Controllers\detailsChangeOrder;
use App\Http\Controllers\DatatableController;

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

//rutas change order order
Route::resource('dash/orders/change_order','App\Http\Controllers\ChangeOrderController');
Route::get('datatable/history_general', 'App\Http\Controllers\DatatableController@getHistoryGeneral')->name('datatable.history_general');
Route::post('orders/destroy', [ChangeOrderController::class, 'destroy'])->name('orders.destroy');



//Rutas select2 Contract Concepts
Route::post('/getMaterials', [ContractOrderController::class, 'getMaterials'])->name('getMaterials');
Route::post('/getEquiptments', [ContractOrderController::class, 'getEquiptments'])->name('getEquiptments');
Route::post('/getLabors', [ContractOrderController::class, 'getLabors'])->name('getLabors');
Route::post('/getOtherExpenses', [ContractOrderController::class, 'getOtherExpenses'])->name('getOtherExpenses');

//Rutas para los datos de las tablas tmp
Route::post('/checktables', [ContractOrderController::class, 'check'])->name('checktables');
Route::post('/insertdata', [ContractOrderController::class, 'store'])->name('insertdata');
Route::post('/deletedata', [ContractOrderController::class, 'destroy'])->name('deletedata');
Route::post('/getgrandtotal', [ContractOrderController::class, 'getNumbers'])->name('getgrandtotal');

//Rutas change order datatables
Route::post('/insertchangedata', [detailsChangeOrder::class, 'add'])->name('inserchangetdata');
Route::post('/getchangegrandtotal', [detailsChangeOrder::class, 'getNumbers'])->name('getchangegrandtotal');
Route::post('/checkchangetables', [detailsChangeOrder::class, 'check'])->name('checkchangetables');
Route::post('/deletechangedata', [detailsChangeOrder::class, 'destroy'])->name('deletechangedata');

 

Route::get('datatable/material_tmp', 'App\Http\Controllers\DatatableController@getMaterialTemp')->name('datatable.material_tmp');
Route::get('datatable/equiptment_tmp', 'App\Http\Controllers\DatatableController@getEquiptmentTemp')->name('datatable.equiptment_tmp');
Route::get('datatable/labor_tmp', 'App\Http\Controllers\DatatableController@getLaborTemp')->name('datatable.labor_tmp');
Route::get('datatable/other_tmp', 'App\Http\Controllers\DatatableController@getOtherTemp')->name('datatable.other_tmp');

Route::post('datatable/material_detail_get', [DatatableController::class, 'getMaterialDetail'])->name('datatable.material_detail_get');/* 
Route::get('datatable/material_detail_get', 'App\Http\Controllers\DatatableController@getMaterialDetail')->name('datatable.material_detail_get'); */
Route::get('datatable/equiptment_detail_get', 'App\Http\Controllers\DatatableController@getEquiptmentDetail')->name('datatable.equiptment_detail_get');
Route::get('datatable/labor_detail_get', 'App\Http\Controllers\DatatableController@getLaborDetail')->name('datatable.labor_detail_get');
Route::get('datatable/other_detail_get', 'App\Http\Controllers\DatatableController@getOtherDetail')->name('datatable.other_detail_get');


Route::post('/saveGeneralDataOrder', [OrdersController::class, 'saveHeader'])->name('saveGeneralDataOrder');
Route::post('/register_order', [OrdersController::class, 'register'])->name('register_order');

//History
Route::resource('dash/history/pending_orders', 'App\Http\Controllers\PendingOrdersController');
Route::resource('dash/history/approved_orders', 'App\Http\Controllers\ApprovedOrdersController');
Route::resource('dash/history/orders_completed', 'App\Http\Controllers\CompletedOrdersController');

Route::get('datatable/history', 'App\Http\Controllers\DatatableController@getHistory')->name('datatable.history');
Route::get('datatable/history_approved', 'App\Http\Controllers\DatatableController@getHistoryApproved')->name('datatable.history_approved');
Route::get('datatable/history_completed', 'App\Http\Controllers\DatatableController@getHistoryCompleted')->name('datatable.history_completed');

Route::get('/download_order', [PendingOrdersController::class, 'download'])->name('download_order');
Route::post('orders/destroy', [PendingOrdersController::class, 'destroy'])->name('orders.destroy');

//History router
Route::post('/changestatus', [OrderStatusController::class, 'changeStatus'])->name('changestatus');
Route::post('/changepaystatus', [OrderStatusController::class, 'changePayStatus'])->name('changepaystatus');
