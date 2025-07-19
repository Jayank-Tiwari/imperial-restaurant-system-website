<?php

use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Delivery\DeliveryDashboardController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\RedirectIfAuthenticatedWithRole;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');


Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/booking', [BookingController::class, 'homeindex'])->name('booking');
Route::post('/book-table', [BookingController::class, 'store'])->name('booking.store')->middleware('auth');
Route::get('/menu', [MenuController::class, 'homeindex'])->name('menu');

Route::middleware(RedirectIfAuthenticatedWithRole::class)->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/forgot-password', [ForgotPasswordController::class, 'showRequestForm'])->name('password.request');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'verifyUser'])->name('password.verify');

    Route::get('/reset-password/{email}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword'])->name('password.update');
});
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Dashboard
Route::middleware(['auth', RoleMiddleware::class])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/booking', [BookingController::class, 'index'])->name('admin.booking');
    Route::get('/user/dashboard', [UserController::class, 'index'])->name('user.dashboard');
    Route::get('/user/reservations', [UserController::class, 'myReservations'])->name('user.reservations');

    // Booking Edit/Update
    Route::get('/admin/bookings/{id}/edit', [BookingController::class, 'edit'])->name('admin.booking.edit');
    Route::put('/bookings/{id}', [BookingController::class, 'update'])->name('admin.booking.update');

    // ✅ Menu Management Routes
    Route::get('/admin/menu-management', [MenuController::class, 'index'])->name('admin.menu-management'); // List
    Route::get('/admin/menu/create', [MenuController::class, 'create'])->name('admin.menu.create');        // Form
    Route::post('/admin/menu', [MenuController::class, 'store'])->name('admin.menu.store');                // Store new
    Route::get('/admin/menu/{id}/edit', [MenuController::class, 'edit'])->name('admin.menu.edit');         // Edit form
    Route::put('/admin/menu/{id}', [MenuController::class, 'update'])->name('admin.menu.update');          // Update item
    Route::delete('/admin/menu/{id}', [MenuController::class, 'destroy'])->name('admin.menu.destroy');     // Delete

    //Category Management
    Route::get('/admin/categories', [CategoryController::class, 'index'])->name('admin.categories.index');
    Route::get('/admin/category/create', [CategoryController::class, 'create'])->name('admin.categories.create');
    Route::post('/admin/category', [CategoryController::class, 'store'])->name('admin.categories.store');
    Route::get('/admin/category/{id}/edit', [CategoryController::class, 'edit'])->name('admin.categories.edit');
    Route::put('/admin/category/{id}', [CategoryController::class, 'update'])->name('admin.categories.update');
    Route::delete('/admin/category/{id}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');

    // Show profile settings page
    Route::get('/profile-setting', [ProfileController::class, 'edit'])->name('admin.profile-setting');

    // Update profile details (name, email, phone)
    Route::put('/profile-setting/update', [ProfileController::class, 'update'])->name('admin.profile.update');
    Route::get('admin/users', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('admin.users');
    Route::get('admin/users/{user}/view', [\App\Http\Controllers\Admin\UserController::class, 'show'])->name('admin.users.view');
    Route::get('admin/users/{user}/edit', [\App\Http\Controllers\Admin\UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('admin/users/{user}/update', [\App\Http\Controllers\Admin\UserController::class, 'update'])->name('admin.users.update');

    Route::get('admin/order', [OrderController::class, 'index'])->name('admin.order.index');
    Route::put('admin/order/{order}/status', [OrderController::class, 'updateStatus'])->name('admin.order.updateStatus');
    Route::get('admin/order/{order}', [OrderController::class, 'show'])->name('admin.order.show');
    Route::put('admin/order/{order}/payment', [OrderController::class, 'updatePayment'])->name('admin.order.updatePayment');
    Route::get('admin/delivery-staff', [DeliveryController::class, 'index'])->name('admin.delivery.staff');
    Route::post('admin/assign-delivery', [DeliveryController::class, 'assign'])->name('admin.delivery.assign');
    Route::get('admin/delivery-staff/{id}/orders', [DeliveryController::class, 'viewOrders'])->name('admin.delivery.orders');

});

Route::prefix('delivery')->middleware(['auth', RoleMiddleware::class])->group(function () {
    Route::get('/dashboard', [DeliveryDashboardController::class, 'index'])->name('delivery.dashboard');
    Route::get('/orders/{id}', [DeliveryDashboardController::class, 'show'])->name('delivery.orders.show');
    Route::post('/orders/{id}/verify-otp', [DeliveryDashboardController::class, 'verifyOtp'])->name('delivery.orders.verifyOtp');
    Route::get('/delivered-orders', [DeliveryDashboardController::class, 'deliveredOrders'])->name('delivered.orders');
});
Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::put('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
});
Route::get('/checkout', [CheckoutController::class, 'show'])->name('checkout');
Route::post('/checkout/dinein', [CheckoutController::class, 'storeDineIn'])->name('checkout.dinein');
Route::post('/checkout/delivery', [CheckoutController::class, 'storeDelivery'])->name('checkout.delivery');
Route::match(['get', 'post'], 'checkout/payment-success', [StripeController::class, 'paymentSuccess'])->name('checkout.payment.success');
Route::get('/stripe/checkout', [StripeController::class, 'checkout'])->name('stripe.checkout');
