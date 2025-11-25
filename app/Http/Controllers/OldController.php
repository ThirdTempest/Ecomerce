<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppController; 
use App\Http\Controllers\AdminController; 

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- Public/User Routes ---
Route::controller(AppController::class)->group(function () {
    // Home Page
    Route::get('/', 'index')->name('home');

    // Shop Page
    Route::get('/shop', 'shopAll')->name('shop');

    // Authentication Views (GET)
    Route::middleware('guest')->group(function () {
        Route::get('/login', 'login')->name('login');
        Route::get('/register', 'register')->name('register');
    });
    
    // Protected User Routes (Requires Auth)
    Route::middleware('auth')->group(function () {
        Route::get('/profile', 'profile')->name('profile');
        Route::post('/logout', 'logout')->name('logout');
        
        // --- PROFILE SUB-PAGES ---
        Route::get('/profile/orders', 'orderHistory')->name('profile.orders');
        Route::get('/profile/addresses', 'savedAddresses')->name('profile.addresses');
        
        // Cart Functionality Routes
        Route::post('/cart/add', 'addToCart')->name('cart.add'); 
        Route::post('/cart/remove', 'removeFromCart')->name('cart.remove'); 
        Route::get('/cart', 'viewCart')->name('cart.view'); 
        
        // Checkout Flow
        Route::get('/checkout/shipping', 'showShippingForm')->name('checkout.showForm'); 
        Route::post('/checkout/initiate', 'initiatePayment')->name('checkout.initiate'); 
        Route::get('/checkout/success', 'checkoutSuccess')->name('checkout.success'); 
        Route::get('/checkout/failure', 'checkoutFailure')->name('checkout.failure'); 
    });

    // Authentication Logic (POST)
    Route::post('/login', 'storeLogin')->name('login.store');
    Route::post('/register', 'storeRegister')->name('register.store');
});


// --- Admin Panel Routes (Requires Auth) ---
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::controller(AdminController::class)->group(function () {
        Route::get('/', 'index')->name('dashboard');
        
        // Product Management
        Route::get('/products', 'indexProducts')->name('products.index'); 
        Route::get('/products/create', 'createProduct')->name('products.create');
        Route::post('/products', 'storeProduct')->name('products.store');
        Route::get('/products/{product}/edit', 'editProduct')->name('products.edit'); 
        Route::put('/products/{product}', 'updateProduct')->name('products.update'); 
        
        // Low Stock Alerts (NEW ROUTE)
        Route::get('/products/low-stock', 'lowStockAlerts')->name('products.lowStock'); 
        
        // Order Management
        Route::get('/orders', 'indexOrders')->name('orders.index');
        Route::put('/orders/{order}/status', 'updateOrderStatus')->name('orders.updateStatus');
    });
});