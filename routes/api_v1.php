<?php

use App\Http\Controllers\Api\V1\CategoriesController;
use App\Http\Controllers\Api\V1\TransactionTypesController;
use App\Http\Controllers\Api\V1\UsersController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Api\V1\TransactionController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group(function () {
    Route::middleware('auth:sanctum')->apiResource('transactions', TransactionController::class);
    Route::middleware('auth:sanctum')->apiResource('users', UsersController::class);
    Route::middleware('auth:sanctum')->apiResource('transactionTypes', TransactionTypesController::class);
    Route::middleware('auth:sanctum')->apiResource('categories', CategoriesController::class);
});
