<?php

use App\Http\Controllers\BondController;
use App\Http\Controllers\OrderController;
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


Route::get('/bond/{id}', [BondController::class, 'bondPaymentDates']);
Route::post('/bond/{id}/order', [OrderController::class, 'store']);
Route::post('/bond/order/{order}', [OrderController::class, 'bondOrderPayments']);
