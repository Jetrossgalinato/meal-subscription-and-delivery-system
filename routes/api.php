<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\PaymentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController; //route for creating user
use App\Http\Controllers\Api\UserController; //route for getting user details


// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get('products', [ProductController::class, 'index']);
Route::post('pay/order', [PaymentController::class, 'payByStripe']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/user/{id}', [UserController::class, 'getUserDetails']);
Route::post('/user/{id}/update', [UserController::class, 'updateUser']);
