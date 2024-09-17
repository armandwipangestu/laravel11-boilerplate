<?php

use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/users', [UserController::class, 'index']);
Route::post('/users', [UserController::class, 'store']);
Route::get('/users/{id}', [UserController::class, 'show']);
Route::put('/users/{id}', [UserController::class, 'update']);
Route::delete('/users/{id}', [UserController::class, 'destroy']);

Route::get('/tests', [TestController::class, 'index']);
Route::post('/tests', [TestController::class, 'store']);
Route::get('/tests/{id}', [TestController::class, 'show']);
Route::put('/tests/{id}', [TestController::class, 'update']);
Route::delete('/tests/{id}', [TestController::class, 'destroy']);
