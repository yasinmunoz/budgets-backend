<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BudgetsController;
use App\Http\Controllers\BudgetStatesController;
use App\Http\Controllers\BudgetLinesController;
use App\Http\Controllers\BudgetLineStatesController;
use App\Http\Controllers\ProductsController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('users')->group(function () {
    Route::post('', [UsersController::class, 'index']);
    Route::get('', [UsersController::class, 'index']);
    Route::get('{id}', [UsersController::class, 'show']);
    Route::put('', [UsersController::class, 'store']);
    Route::patch('{id}', [UsersController::class, 'store']);
    Route::delete('', [UsersController::class, 'destroy']);
});

Route::prefix('budgets')->group(function () {
    Route::post('', [BudgetsController::class, 'index']);
    Route::get('', [BudgetsController::class, 'index']);
    Route::get('{id}', [BudgetsController::class, 'show']);
    Route::put('', [BudgetsController::class, 'store']);
    Route::patch('{id}', [BudgetsController::class, 'store']);
    Route::delete('', [BudgetsController::class, 'destroy']);

    Route::prefix('states')->group(function () {
        Route::post('', [BudgetStatesController::class, 'index']);
        Route::get('', [BudgetStatesController::class, 'index']);
        Route::get('{id}', [BudgetStatesController::class, 'show']);
        Route::put('', [BudgetStatesController::class, 'store']);
        Route::patch('{id}', [BudgetStatesController::class, 'store']);
        Route::delete('', [BudgetStatesController::class, 'destroy']);
    });

    Route::prefix('lines')->group(function () {
        Route::post('', [BudgetLinesController::class, 'index']);
        Route::get('', [BudgetLinesController::class, 'index']);
        Route::get('{id}', [BudgetLinesController::class, 'show']);
        Route::put('', [BudgetLinesController::class, 'store']);
        Route::patch('{id}', [BudgetLinesController::class, 'store']);
        Route::delete('', [BudgetLinesController::class, 'destroy']);
        Route::post('states', [BudgetLinesController::class, 'states']);

        Route::prefix('states')->group(function () {
            Route::post('', [BudgetLineStatesController::class, 'index']);
            Route::get('', [BudgetLineStatesController::class, 'index']);
            Route::get('{id}', [BudgetLineStatesController::class, 'show']);
            Route::put('', [BudgetLineStatesController::class, 'store']);
            Route::patch('{id}', [BudgetLineStatesController::class, 'store']);
            Route::delete('', [BudgetLineStatesController::class, 'destroy']);
        });
    });
});

Route::prefix('products')->group(function () {
    Route::post(    '',    [ProductsController::class, 'index']);
    Route::get(     '',    [ProductsController::class, 'index']);
    Route::get(     '{id}',[ProductsController::class, 'show']);
    Route::put(     '',    [ProductsController::class, 'store']);
    Route::patch(   '{id}',[ProductsController::class, 'store']);
    Route::delete(  '',    [ProductsController::class, 'destroy']);
});
