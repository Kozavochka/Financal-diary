<?php


use App\Http\Controllers\Admin\AdminBondController;
use App\Http\Controllers\Admin\AdminCryptoController;
use App\Http\Controllers\Admin\AdminDirectionController;
use App\Http\Controllers\Admin\AdminFundController;
use App\Http\Controllers\Admin\AdminIncomeController;
use App\Http\Controllers\Admin\AdminIndexController;
use App\Http\Controllers\Admin\AdminLoanController;
use App\Http\Controllers\Admin\AdminStockController;
use App\Http\Controllers\Admin\Record\RecordController;
use App\Http\Controllers\Admin\Record\StockRecordController;
use Illuminate\Support\Facades\Route;
use Telegram\Bot\Laravel\Facades\Telegram;


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
/* Роуты на активы */
Route::get('stocks/export', [AdminStockController::class, 'excel_export'])->name('excel_export');
Route::resource('/stocks', AdminStockController::class)->names('admin.stocks');

Route::resource('/bonds', AdminBondController::class)->names('admin.bonds');

Route::resource('/funds',AdminFundController::class)->names('admin.funds');

Route::resource('/loans', AdminLoanController::class)->names('admin.loans');

Route::resource('/crypto', AdminCryptoController::class)->names('admin.crypto');

Route::resource('/stock_record',StockRecordController::class)->names('stocks.record');

Route::resource('/record', RecordController::class)->names('records');

Route::resource('/incomes', AdminIncomeController::class)->names('admin.incomes');

Route::resource('/directions', AdminDirectionController::class)->names('admin.directions');

/* Телеграмм */
Route::get('/set-tg',[AdminIndexController::class,'setTG'])->name('set-tg');

Route::get('/', [\App\Http\Controllers\Admin\AdminIndexController::class,'index'])->name('admin.index');

Route::resource('/stocks', \App\Http\Controllers\Admin\AdminStockController::class)->names('admin.stocks');

