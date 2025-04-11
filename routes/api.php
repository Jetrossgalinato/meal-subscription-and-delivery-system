<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Api\PaymentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController; //route for creating user
use App\Http\Controllers\Api\UserController; //route for getting user details
use App\Http\Controllers\Api\MealController; //route for getting meals
use App\Http\Controllers\Api\AdminController; //route for admin dashboard
use App\Http\Controllers\Api\CartController; //route for cart
use App\Models\Meal;
use App\Http\Controllers\CheckoutController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('pay/order', [PaymentController::class, 'payByStripe']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/user/{id}', [UserController::class, 'getUserDetails']);
Route::post('/user/{id}/update', [UserController::class, 'updateUser']);
Route::get('/meals', [MealController::class, 'getMeals']);
Route::get('/admin/dashboard', [AdminController::class, 'index']);;
Route::post('/meals', [MealController::class, 'store']);
Route::post('pay-by-stripe', [PaymentController::class, 'payByStripe']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/cart', [CartController::class, 'addToCart']); // Add meal to cart
    Route::get('/cart', [CartController::class, 'getCartItems']); // Get all cart items
    Route::delete('/cart/{id}', [CartController::class, 'removeFromCart']); // Remove meal from cart
});
Route::get('/test-meals', function () {
    return Meal::all(); // this will now include `image_url` per item
});
Route::middleware('auth:sanctum')->post('/checkout', [CheckoutController::class, 'checkout']);
