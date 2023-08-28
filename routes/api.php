<?php


use App\Http\Controllers\api\v1\UserController;
use App\Http\Controllers\Api\v1\CategoryController;
use App\Http\Controllers\Api\v1\OrderController;
use App\Http\Controllers\Api\v1\OrderDetailsController;
use App\Http\Controllers\Api\v1\ProductController;
use App\Http\Controllers\Api\v1\ProductReviewController;
use App\Http\Controllers\Api\v1\ShippingAddressController;
use App\Http\Controllers\Api\v1\WishlistController;
use Illuminate\Support\Facades\Route;




Route::prefix('v1')->middleware('auth:sanctum')->group(function () {


    Route::apiResource("users", UserController::class);
    Route::apiResource("categories", CategoryController::class);
    Route::apiResource("products", ProductController::class);
    Route::apiResource("orders", OrderController::class);
    Route::apiResource("ordersdetails", OrderDetailsController::class);
    Route::apiResource("productreviews", ProductReviewController::class);
    Route::apiResource("wishlists", WishlistController::class);
    Route::apiResource("shippingaddress", ShippingAddressController::class);
    Route::post('/logout', [UserController::class, 'revokeToken']);
});

Route::prefix('v1')->group(function () {


    Route::post('/login', [UserController::class, 'createToken']);
    Route::post('/register', [UserController::class, 'store']);
});
