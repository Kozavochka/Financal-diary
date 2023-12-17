<?php

use App\Http\Controllers\Guest\BondController;
use App\Http\Controllers\Guest\StockController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\TelegramController;
use Illuminate\Http\Request;
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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

//Роут на экспорт портфеля
Route::get('/pdf', [HomeController::class,'pdf_export'])->name('general_pdf');

Route::get('/home', [HomeController::class, 'index'])->name('home');

//Група рутов на разделы гостя
Route::group(['middleware' => 'auth'], function (){
    Route::get('stocks/export', [StockController::class, 'excel_export'])->name('excel_export');
    Route::resource('/stocks',StockController::class)->names('stocks');

    Route::resource('/bonds', BondController::class)->names('bonds');

    Route::resource('/settings', SettingsController::class)->names('settings');
});

//Роут веб хука
Route::post('/reset-tg',[TelegramController::class,'reset'])->name('reset-pass');
Route::post('/webhook', [TelegramController::class,'webhook']);
Route::get('/tg/{user}',[TelegramController::class,'index'])->name('tg');
Route::post('/reset-tg-form', [TelegramController::class,'reset_show'])->name('reset-tg');



