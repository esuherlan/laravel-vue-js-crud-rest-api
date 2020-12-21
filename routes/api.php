<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CustomerController;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::get('/customers', [CustomerController::class, 'index'])->middleware('auth:api');
Route::post('/customers/store', [CustomerController::class, 'store'])->middleware('auth:api');
Route::get('/customers/{id?}', [CustomerController::class, 'show'])->middleware('auth:api');
Route::post('/customers/update/{id?}', [CustomerController::class, 'update'])->middleware('auth:api');
Route::delete('/customers/{id?}', [CustomerController::class, 'destroy'])->middleware('auth:api');