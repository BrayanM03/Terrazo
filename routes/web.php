<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\EquiptmentController;
use App\Http\Controllers\LaborController;
use App\Http\Controllers\OtherExpensisController;

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

Route::resource('dash/categories/equiptments', 'App\Http\Controllers\EquiptmentController');
Route::post('dash/categories/equiptments/created', [EquiptmentController::class, 'store']);


Route::resource('dash/categories/labors', 'App\Http\Controllers\LaborController');
Route::post('dash/categories/labors/created', [LaborController::class, 'store']);

Route::resource('dash/categories/other_expenses', 'App\Http\Controllers\OtherExpensisController');
Route::post('dash/categories/other_expenses/created', [OtherExpensisController::class, 'store']);