<?php


use App\Http\Controllers\Admin\AdminBankController;
use App\Http\Controllers\Admin\AdminCashController;
use App\Http\Controllers\Admin\AdminCompanyController;
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

Route::resource('/loans', AdminLoanController::class)->names('admin.loans')->except('show');
Route::get('/loans/frontiers', [AdminLoanController::class, 'getFrontiers'])->name('admin.loans.frontiers');
Route::post('/loans/frontiers/sync', [AdminLoanController::class, 'syncFrontiersLoans'])->name('admin.loans.frontiers_sync');


Route::resource('/crypto', AdminCryptoController::class)->names('admin.crypto');
Route::post('/crypto/bybit/sync', [AdminCryptoController::class, 'syncByBit'])->name('admin.crypto.bybit_sync');

Route::resource('/incomes', AdminIncomeController::class)->names('admin.incomes');

Route::resource('/directions', AdminDirectionController::class)->names('admin.directions');

Route::resource('/industries', AdminIndustryController::class)->names('admin.industries');

Route::resource('/deposits',AdminDepositController::class)->names('admin.deposits');

Route::resource('/cash',AdminCashController::class)->names('admin.cash');

Route::resource('/currency',AdminCurrencyAccountController::class)->names('admin.currency');

Route::resource('/banks',AdminBankController::class)->names('admin.bank');

Route::resource('/companies',AdminCompanyController::class)->names('admin.company');



