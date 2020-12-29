<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CustomerController;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
   Route::get('/customers', [CustomerController::class, 'index']);
   Route::post('/customers/store', [CustomerController::class, 'store']);
   Route::get('/customers/detail/{id?}', [CustomerController::class, 'detail']);
   Route::post('/customers/update/{id?}', [CustomerController::class, 'update']);
   Route::delete('/customers/delete/{id?}', [CustomerController::class, 'delete']);
});