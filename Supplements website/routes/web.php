<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [ProductController::class, 'index'])->name('products.index');
Route::get('/products', [ProductController::class, 'list'])->name('products.list');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
Route::get('/about', [ProductController::class, 'about'])->name('about');
Route::get('/contact', [ProductController::class, 'contact'])->name('contact');
Route::post('/contact', [ProductController::class, 'storeContact'])->name('contact.store');

// Password Reset Routes
Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgotForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetCode'])->name('password.send-code');
Route::get('/verify-code', [ForgotPasswordController::class, 'showVerifyForm'])->name('password.verify');
Route::post('/verify-code', [ForgotPasswordController::class, 'verifyCode'])->name('password.verify-code');
Route::get('/reset-password', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword'])->name('password.update');



// Authenticated user routes
Route::middleware('auth')->group(function () {
    // User Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Profile Management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Order Management
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');

    // User Inbox
    Route::get('/inbox', [MessageController::class, 'inbox'])->name('messages.inbox');
    Route::get('/messages/{message}', [MessageController::class, 'show'])->name('messages.show');
    Route::post('/messages/clear-notifications', [MessageController::class, 'clearNotifications'])->name('messages.clear-notifications');


    // Cart Routes
    Route::post('/cart/add/{product}', [CheckoutController::class, 'addToCart'])->name('cart.add');
    Route::get('/cart', [CheckoutController::class, 'viewCart'])->name('cart.view');
    Route::patch('/cart/{product}', [CheckoutController::class, 'updateCart'])->name('cart.update');
    Route::delete('/cart/{product}', [CheckoutController::class, 'removeFromCart'])->name('cart.remove');
    Route::delete('/cart', [CheckoutController::class, 'clearCart'])->name('cart.clear');

    // Payment Routes
    Route::post('/create-payment-intent', [PaymentController::class, 'createPaymentIntent'])->name('payment.create-intent');
    Route::post('/confirm-payment', [PaymentController::class, 'confirmPayment'])->name('payment.confirm');
    Route::post('/cod-order', [PaymentController::class, 'codOrder'])->name('payment.cod');

    // Checkout Routes
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');
    Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
    Route::get('/checkout/cancel', [CheckoutController::class, 'cancel'])->name('checkout.cancel');
});

// Admin authentication routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminController::class, 'login'])->name('login.submit');
    Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
});

// Protected admin routes
Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Product management
    Route::get('/products', [AdminController::class, 'products'])->name('products.index');
    Route::get('/products/create', [AdminController::class, 'createProduct'])->name('products.create');
    Route::post('/products', [AdminController::class, 'storeProduct'])->name('products.store');
    Route::get('/products/{id}/edit', [AdminController::class, 'editProduct'])->name('products.edit');
    Route::put('/products/{product}', [AdminController::class, 'updateProduct'])->name('products.update');
    Route::post('/products/{product}/add-stock', [AdminController::class, 'addStock'])->name('products.add-stock');
    Route::delete('/products/{product}', [AdminController::class, 'destroyProduct'])->name('products.destroy');
    Route::post('/products/{id}/restore', [AdminController::class, 'restoreProduct'])->name('products.restore');
    
    
    // Order management
    Route::get('/orders', [AdminController::class, 'orders'])->name('orders.index');
    Route::get('/orders/{order}', [AdminController::class, 'showOrder'])->name('orders.show');
    Route::put('/orders/{order}', [AdminController::class, 'updateOrder'])->name('orders.update');
    Route::delete('/orders/{order}', [AdminController::class, 'destroyOrder'])->name('orders.destroy');
    
    // Settings management
    Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
    Route::post('/settings', [AdminController::class, 'updateSettings'])->name('settings.update');
    
    
    // Category management
    Route::post('/categories', [AdminController::class, 'storeCategory'])->name('categories.store');
    Route::put('/categories/{category}', [AdminController::class, 'updateCategory'])->name('categories.update');
    Route::delete('/categories/{category}', [AdminController::class, 'destroyCategory'])->name('categories.destroy');
    
    // Promotional products management
    Route::post('/promotions', [AdminController::class, 'storePromotion'])->name('promotions.store');
    Route::put('/promotions/{promotion}', [AdminController::class, 'updatePromotion'])->name('promotions.update');
    Route::delete('/promotions/{promotion}', [AdminController::class, 'destroyPromotion'])->name('promotions.destroy');
    
    // Message/Inbox management
    Route::get('/messages', [AdminController::class, 'messages'])->name('messages.index');
    Route::get('/messages/{message}', [AdminController::class, 'showMessage'])->name('messages.show');
    Route::post('/messages/{message}/reply', [AdminController::class, 'replyMessage'])->name('messages.reply');
    Route::delete('/messages/{message}', [AdminController::class, 'deleteMessage'])->name('messages.delete');
    
});

require __DIR__.'/auth.php';
