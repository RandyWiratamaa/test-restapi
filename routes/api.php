<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\OrderController;

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

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::get('logs', [AdminController::class, 'addToLog']);
Route::get('log_activities', [AdminController::class, 'logActivity']);
Route::get('export', [OrderController::class, 'export']);

Route::group(['middleware' => ['auth:sanctum']], function(){
    // return $request->user();
    Route::post('order', [OrderController::class, 'store']);
    Route::get('order/{invoice_number}', [OrderController::class, 'show']);
    Route::delete('order/{invoice_number}', [OrderController::class, 'destroy']);


    Route::post('logout', [AuthController::class, 'logout']);
});
