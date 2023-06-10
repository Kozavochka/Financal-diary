<?php

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

Route::get('/', [\App\Http\Controllers\Admin\AdminIndexController::class,'index'])->name('admin.index');

Route::resource('/stocks', \App\Http\Controllers\Admin\AdminStockController::class)->names('admin.stocks');

Route::resource('/bonds', \App\Http\Controllers\Admin\AdminBondController::class)->names('admin.bonds');
