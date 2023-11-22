<?php


use App\Http\Controllers\Admin\Statistic\StatisticController;
use Illuminate\Support\Facades\Route;


Route::get('/', [StatisticController::class,'index'])->name('statistic.index');

Route::post('/create', [StatisticController::class,'create'])->name('statistic.create');
