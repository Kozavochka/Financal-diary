<?php


use App\Http\Controllers\Admin\AdminCashController;
use App\Http\Controllers\Admin\AdminDirectionController;
use App\Http\Controllers\Admin\AdminIncomeController;
use App\Http\Controllers\Admin\AdminIndustryController;
use App\Http\Controllers\Admin\AdminPanelController;
use App\Http\Controllers\Admin\Assets\AdminBondController;
use App\Http\Controllers\Admin\Assets\AdminCryptoController;
use App\Http\Controllers\Admin\Assets\AdminDepositController;
use App\Http\Controllers\Admin\Assets\AdminFundController;
use App\Http\Controllers\Admin\Assets\AdminLoanController;
use App\Http\Controllers\Admin\Assets\AdminStockController;
use App\Http\Controllers\SettingsController;
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

/* Телеграмм */
Route::get('/set-tg',[AdminPanelController::class,'setTG'])->name('set-tg');

Route::get('/', [\App\Http\Controllers\Admin\AdminPanelController::class,'index'])->name('admin.index');

Route::post('/settings/update', [SettingsController::class,'updateSettings'])->name('settings.update');



