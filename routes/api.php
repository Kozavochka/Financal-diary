<?php

use App\Http\Controllers\API\Admin\ApiAdminController;
use App\Http\Controllers\API\Admin\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'admin.api', 'prefix' => 'admin'], function (){
    Route::apiResource('/', ApiAdminController::class);
});

