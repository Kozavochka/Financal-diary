<?php

use App\Http\Controllers\API\Admin\AdminStockController;
use App\Http\Controllers\API\Admin\ApiAdminController;
use App\Http\Controllers\API\Admin\AuthController;
use App\Http\Controllers\API\Guest\StockController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'admin.api', 'prefix' => 'admin'], function (){
    Route::apiResource('/', ApiAdminController::class);
    Route::apiResource('/stocks', AdminStockController::class);
});
Route::apiResource('/stocks', StockController::class);
