<?php


use App\Http\Controllers\Admin\Statistic\StatisticController;
use Illuminate\Support\Facades\Route;


Route::get('/', [StatisticController::class,'index'])->name('statistic.index');
Route::get('/dynamic', [StatisticController::class,'dynamicStatistic'])->name('statistic.dynamic');
Route::get('/total', [StatisticController::class,'totalStatistic'])->name('statistic.total');
Route::get('/assets', [StatisticController::class,'assetsStatistic'])->name('statistic.assets');

Route::post('/create', [StatisticController::class,'createDynamicStatistic'])->name('statistic.dynamic.create');
