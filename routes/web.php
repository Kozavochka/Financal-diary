<?php

use App\Http\Controllers\Guest\StockController;
use App\Http\Controllers\HomeController;
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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/pdf', [HomeController::class,'pdf_export'])->name('general_pdf');

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function (){
    Route::get('stocks/export', [StockController::class, 'excel_export'])->name('excel_export');
    Route::resource('/stocks',StockController::class)->names('stocks');
});

