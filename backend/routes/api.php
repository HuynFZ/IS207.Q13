<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductVariantController;
use App\Http\Controllers\ProductImageController;
use App\Http\Controllers\SearchController;

// Public routes
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);

// Category Public
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/{id}', [CategoryController::class, 'show']);
Route::get('/categories/{id}/subcategories', [CategoryController::class, 'subcategories']);

// Search & Filter Public
Route::get('/products', [ProductController::class, 'index']); // API 1
Route::get('/products/{id}', [ProductController::class, 'show']); // API 2
Route::get('/search', [SearchController::class, 'search']);
Route::get('/products-trending', [SearchController::class, 'trending']); // Alias for logic separation
Route::get('/products-newest', [SearchController::class, 'newest']);
Route::get('/products-recommended', [SearchController::class, 'recommended']);
Route::get('/products/seller/{sellerId}', [ProductController::class, 'getSellerProducts']); // API 10

// Protected Routes (Cần Token)
Route::middleware('auth:api')->group(function () {
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    Route::get('/auth/me', [AuthController::class, 'me']);

    // Product Management
    Route::post('/products', [ProductController::class, 'store']);
    Route::put('/products/{id}', [ProductController::class, 'update']);
    Route::delete('/products/{id}', [ProductController::class, 'destroy']);
    
    // Variant Management
    Route::post('/products/{id}/variants', [ProductVariantController::class, 'store']);
    Route::put('/variants/{id}', [ProductVariantController::class, 'update']);
    Route::delete('/variants/{id}', [ProductVariantController::class, 'destroy']);

    // Image Management
    Route::post('/products/{id}/images', [ProductImageController::class, 'storeProductImage']);
    Route::delete('/images/{id}', [ProductImageController::class, 'destroy']);
    Route::post('/upload/image', [ProductImageController::class, 'uploadGeneral']);
    Route::delete('/upload/image/delete', [ProductImageController::class, 'deleteGeneral']); // Sửa path chút để dễ handle
});