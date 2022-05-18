<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {
    // auth controller
    Route::post('/login', [AuthController::class, 'store']);
    Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'destroy']);

    // product routes
    Route::middleware('auth:sanctum')->get('/products', [ProductController::class, 'index']);
    Route::middleware('auth:sanctum')->post('/products', [ProductController::class, 'store']);
    Route::middleware('auth:sanctum')->get('/products/{product}', [ProductController::class, 'show']);
    Route::middleware('auth:sanctum')->put('/products/{product}', [ProductController::class, 'update']);
    Route::middleware('auth:sanctum')->delete('/products/{product}', [ProductController::class, 'destroy']);
});
