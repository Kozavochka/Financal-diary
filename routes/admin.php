<?php

use App\Http\Controllers\Admin\AdminBondController;
use App\Http\Controllers\Admin\AdminCryptoController;
use App\Http\Controllers\Admin\AdminFundController;
use App\Http\Controllers\Admin\AdminIndexController;
use App\Http\Controllers\Admin\AdminLoanController;
use App\Http\Controllers\Admin\AdminStockController;
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

Route::get('/', [AdminIndexController::class,'index'])->name('admin.index');

Route::resource('/stocks', AdminStockController::class)->names('admin.stocks');

Route::resource('/bonds', AdminBondController::class)->names('admin.bonds');

Route::resource('/funds',AdminFundController::class)->names('admin.funds');

Route::resource('/loans', AdminLoanController::class)->names('admin.loans');

Route::resource('/crypto', AdminCryptoController::class)->names('admin.crypto');
