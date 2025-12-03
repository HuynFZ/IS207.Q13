<?php

use App\Http\Controllers\TransactionController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ShippingAddressController;
use App\Http\Controllers\CartController;
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

    // --- CART API ---
    Route::get('/cart', [CartController::class, 'index']);             // Xem giỏ
    Route::post('/cart/items', [CartController::class, 'store']);      // Thêm
    Route::put('/cart/items/{id}', [CartController::class, 'update']); // Sửa (id là variant_id)
    Route::delete('/cart/items/{id}', [CartController::class, 'destroy']); // Xóa (id là variant_id)
    Route::delete('/cart', [CartController::class, 'clear']);          // Xóa hết
    // --- SHIPPING ADDRESS API ---
    Route::get('/addresses', [ShippingAddressController::class, 'index']);           // Xem list
    Route::post('/addresses', [ShippingAddressController::class, 'store']);          // Thêm
    Route::put('/addresses/{id}', [ShippingAddressController::class, 'update']);     // Sửa
    Route::delete('/addresses/{id}', [ShippingAddressController::class, 'destroy']); // Xóa
    Route::put('/addresses/{id}/set-default', [ShippingAddressController::class, 'setDefault']); // Đặt mặc định
    // --- ORDER API ---
    Route::post('/orders', [OrderController::class, 'store']);       // 1. Tạo đơn
    Route::get('/orders', [OrderController::class, 'index']);        // 2. Xem list
    Route::get('/orders/{id}', [OrderController::class, 'show']);    // 3. Xem chi tiết
    Route::post('/orders/{id}/cancel', [OrderController::class, 'cancel']); // 4. Hủy đơn
    Route::put('/orders/{id}/status', [OrderController::class, 'updateStatus']); // 5. Cập nhật trạng thái
    // --- WALLET API ---
    Route::get('/wallet', [WalletController::class, 'index']);           // Xem số dư
    Route::post('/wallet/deposit', [WalletController::class, 'deposit']); // Nạp tiền
    Route::post('/wallet/withdraw', [WalletController::class, 'withdraw']); // Rút tiền
    Route::get('/wallet/transactions', [WalletController::class, 'history']); // Lịch sử
    // --- TRANSACTION API ---
    Route::get('/transactions', [TransactionController::class, 'index']);      // Xem danh sách
    Route::get('/transactions/{id}', [TransactionController::class, 'show']);  // Xem chi tiết
    Route::post('/transactions/verify', [TransactionController::class, 'verify']); // Xác thực
});