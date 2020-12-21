<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CustomerController;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::get('/customers', [CustomerController::class, 'index']);
Route::post('/customers/store', [CustomerController::class, 'store']);
Route::get('/customers/{id?}', [CustomerController::class, 'show']);
Route::post('/customers/update/{id?}', [CustomerController::class, 'update']);
Route::delete('/customers/{id?}', [CustomerController::class, 'destroy']);