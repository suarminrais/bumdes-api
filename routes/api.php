<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UpdateAdminUserController;
use App\Http\Controllers\UpdateUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::prefix('v1')->group(function () {
    // user routes
    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
    });
    Route::middleware('auth:sanctum')->post('/admin', [UpdateAdminUserController::class, 'update']);
    Route::middleware('auth:sanctum')->post('/user', [UpdateUserController::class, 'update']);
    Route::middleware('auth:sanctum')->post('/detail', [DetailController::class, 'update']);

    // auth routes
    Route::post('/login', [AuthController::class, 'store']);
    Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'destroy']);

    // register route
    Route::post('/register', [RegisterController::class, 'store']);

    // product routes
    Route::middleware('auth:sanctum')->get('/products', [ProductController::class, 'index']);
    Route::middleware('auth:sanctum')->post('/products', [ProductController::class, 'store']);
    Route::middleware('auth:sanctum')->get('/products/{product}', [ProductController::class, 'show']);
    Route::middleware('auth:sanctum')->put('/products/{product}', [ProductController::class, 'update']);
    Route::middleware('auth:sanctum')->delete('/products/{product}', [ProductController::class, 'destroy']);

    // transaction routes
    Route::middleware('auth:sanctum')->get('/transactions', [TransactionController::class, 'index']);
    Route::middleware('auth:sanctum')->post('/transactions', [TransactionController::class, 'store']);
    Route::middleware('auth:sanctum')->put('/transactions/{transaction}', [TransactionController::class, 'update']);
});
