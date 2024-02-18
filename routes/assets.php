<?php


use App\Http\Controllers\Admin\AdminCashController;
use App\Http\Controllers\Admin\AdminDirectionController;
use App\Http\Controllers\Admin\AdminIncomeController;
use App\Http\Controllers\Admin\AdminIndustryController;
use App\Http\Controllers\Admin\AdminPanelController;
use App\Http\Controllers\Admin\Assets\AdminBondController;
use App\Http\Controllers\Admin\Assets\AdminCryptoController;
use App\Http\Controllers\Admin\Assets\AdminCurrencyAccountController;
use App\Http\Controllers\Admin\Assets\AdminDepositController;
use App\Http\Controllers\Admin\Assets\AdminFundController;
use App\Http\Controllers\Admin\Assets\AdminLoanController;
use App\Http\Controllers\Admin\Assets\AdminStockController;
use Illuminate\Support\Facades\Route;




Route::resource('/stocks', AdminStockController::class)->names('admin.stocks');
Route::get('stocks/export', [AdminStockController::class, 'excel_export'])->name('excel_export');

Route::resource('/bonds', AdminBondController::class)->names('admin.bonds');

Route::resource('/funds',AdminFundController::class)->names('admin.funds');

Route::resource('/loans', AdminLoanController::class)->names('admin.loans');

Route::resource('/crypto', AdminCryptoController::class)->names('admin.crypto');

Route::resource('/incomes', AdminIncomeController::class)->names('admin.incomes');

Route::resource('/directions', AdminDirectionController::class)->names('admin.directions');

Route::resource('/industries', AdminIndustryController::class)->names('admin.industries');

Route::resource('/deposits',AdminDepositController::class)->names('admin.deposits');

Route::resource('/cash',AdminCashController::class)->names('admin.cash');

Route::resource('/currency',AdminCurrencyAccountController::class)->names('admin.currency');



