<?php

use App\Http\Controllers\Api\InventoryController;
use App\Http\Controllers\Api\TransactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/inventory', [InventoryController::class, 'index']);
Route::get('/inventory/{id}', [InventoryController::class, 'show']);
Route::put('/inventory/{id}/quantity', [InventoryController::class, 'updateQuantity']);

Route::post('/transactions', [TransactionController::class, 'store']);
