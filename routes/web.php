<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\frontend\CartController;
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\frontend\Auth\RegisterController;
use App\Http\Controllers\frontend\CheckoutController;
use App\Http\Controllers\frontend\CustomerController;
use App\Http\Controllers\backend\CouponController;
use App\Http\Controllers\backend\ProductController;
use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\backend\DashboardController;
use App\Http\Controllers\backend\OrderController;
use App\Http\Controllers\backend\TestimonialController;
use App\Http\Controllers\backend\CustomerController as BackendCustomerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::prefix('')->group(function(){
    Route::get('/', [HomeController::class, 'home'])->name('home');
    Route::get('/shop', [HomeController::class, 'shopPage'])->name('shop.page');
    Route::get('/single-product/{product_slug}', [HomeController::class, 'productDetails'])->name('productdetails.page');
    Route::get('/shopping-cart', [CartController::class, 'cartPage'])->name('cart.page');
    Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('addTo-cart');
    Route::get('/remove-from-cart/{cart_id}', [CartController::class, 'removeFromCart'])->name('removefrom.cart');

    /* Authentication Routes for guest/user */
    Route::get('/register', [RegisterController::class, 'registerPage'])->name('register.page');
    Route::post('/register', [RegisterController::class, 'registerStore'])->name('register.store');
    Route::get('/login', [RegisterController::class, 'loginPage'])->name('login.page');
    Route::post('/login', [RegisterController::class, 'loginStore'])->name('login.store');
});

// Load upazila ajax
Route::get('/upazila/ajax/{district_id}', [CheckoutController::class, 'loadUpazilaAjax'])->name('loadupazila.ajax');

Route::prefix('customer/')->middleware(['auth', 'is_customer'])->group(function(){
    Route::get('dashboard', [CustomerController::class, 'dashboard'])->name('customer.dashboard');
    Route::get('logout', [RegisterController::class, 'logout'])->name('customer.logout');

    // coupon apply and remove
    Route::post('cart/apply-coupon', [CartController::class, 'couponApply'])->name('customer.couponapply');
    Route::get('cart/remove-coupon/{coupon_name}', [CartController::class, 'couponRemove'])->name('customer.couponremove');

    // Checkout Page

    Route::get('checkout', [CheckoutController::class, 'checkoutPage'])->name('customer.checkoutpage');
    Route::post('placeorder', [CheckoutController::class, 'placeOrder'])->name('customer.placeorder');
});

/* Admin Auth Routes */
Route::prefix('admin/')->group(function(){
    Route::get('login', [LoginController::class, 'loginPage'])->name('admin.loginpage');
    Route::post('login', [LoginController::class, 'login'])->name('admin.login');
    Route::get('logout', [LoginController::class, 'logout'])->name('admin.logout');

    Route::middleware(['auth', 'is_admin'])->group(function(){
        Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');

    // Resource Controller
    Route::resource('category', CategoryController::class);
    Route::resource('testimonial', TestimonialController::class);
    Route::resource('product', ProductController::class);
    Route::resource('coupon', CouponController::class);
    Route::get('order-list', [OrderController::class, 'index'])->name('admin.orderlist');
    Route::get('customer-list', [BackendCustomerController::class, 'index'])->name('admin.customerlist');
    });


});

