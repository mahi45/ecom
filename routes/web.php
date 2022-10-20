<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\backend\ProductController;
use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\backend\CouponController;
use App\Http\Controllers\backend\DashboardController;
use App\Http\Controllers\backend\TestimonialController;
use App\Http\Controllers\frontend\CartController;

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
});

/* Admin Auth Routes */
Route::prefix('admin/')->group(function(){
    Route::get('login', [LoginController::class, 'loginPage'])->name('admin.loginpage');
    Route::post('login', [LoginController::class, 'login'])->name('admin.login');
    Route::get('logout', [LoginController::class, 'logout'])->name('admin.logout');

    Route::middleware('auth')->group(function(){
        Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');
    });

    // Resource Controller
    Route::resource('category', CategoryController::class);
    Route::resource('testimonial', TestimonialController::class);
    Route::resource('product', ProductController::class);
    Route::resource('coupon', CouponController::class);
});

