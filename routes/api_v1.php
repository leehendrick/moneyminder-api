<?php

use App\Http\Controllers\Api\V1\CategoriesController;
use App\Http\Controllers\Api\V1\TransactionTypesController;
use App\Http\Controllers\Api\V1\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Api\V1\TransactionController;
use \App\Http\Controllers\Api\V1\UserTransactionsController;


Route::middleware('auth:sanctum')->prefix('v1')->group(function () {

    Route::apiResource('users', UsersController::class);
    Route::apiResource('transactions', TransactionController::class)->except(['update']);
    Route::put('transactions/{transaction}', [TransactionController::class, 'replace']);
    Route::patch('transactions/{transaction}', [TransactionController::class, 'update']);

    Route::apiResource('transactionTypes', TransactionTypesController::class);

    Route::apiResource('categories', CategoriesController::class);

    Route::apiResource('users.transactions', UserTransactionsController::class)->except(['update']);
    Route::put('users/{user}/transactions/{transaction}', [UserTransactionsController::class, 'replace']);
    Route::patch('users/{user}/transactions/{transaction}', [UserTransactionsController::class, 'update']);

    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});
