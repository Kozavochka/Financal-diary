<?php


use App\Http\Controllers\Admin\AdminBondController;
use App\Http\Controllers\Admin\AdminCashController;
use App\Http\Controllers\Admin\AdminCryptoController;
use App\Http\Controllers\Admin\AdminDepositController;
use App\Http\Controllers\Admin\AdminDirectionController;
use App\Http\Controllers\Admin\AdminFundController;
use App\Http\Controllers\Admin\AdminIncomeController;
use App\Http\Controllers\Admin\AdminPanelController;
use App\Http\Controllers\Admin\AdminIndustryController;
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


Route::get('/', [AdminPanelController::class,'index'])->name('admin.index');
/* Роуты на активы */
Route::get('stocks/export', [AdminStockController::class, 'excel_export'])->name('excel_export');
Route::resource('/stocks', AdminStockController::class)->names('admin.stocks');

Route::resource('/bonds', AdminBondController::class)->names('admin.bonds');

Route::resource('/funds',AdminFundController::class)->names('admin.funds');

Route::resource('/loans', AdminLoanController::class)->names('admin.loans');

Route::resource('/crypto', AdminCryptoController::class)->names('admin.crypto');

Route::resource('/incomes', AdminIncomeController::class)->names('admin.incomes');

Route::resource('/directions', AdminDirectionController::class)->names('admin.directions');

Route::resource('/industries', AdminIndustryController::class)->names('admin.industries');

Route::resource('/deposits',AdminDepositController::class)->names('admin.deposits');

Route::resource('/cash',AdminCashController::class)->names('admin.cash');
/* Телеграмм */
Route::get('/set-tg',[AdminPanelController::class,'setTG'])->name('set-tg');

Route::get('/', [\App\Http\Controllers\Admin\AdminPanelController::class,'index'])->name('admin.index');

Route::resource('/stocks', \App\Http\Controllers\Admin\AdminStockController::class)->names('admin.stocks');

