<?php

use App\Exports\UsersExport;
use App\Http\Controllers\backend\AdminController;
use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\backend\DashboardController;
use App\Http\Controllers\backend\OrderController as BackendOrderController;
use App\Http\Controllers\backend\ProductController;
use App\Http\Controllers\backend\ProfileController;
use App\Http\Controllers\backend\UserController as BackendUserController;
use App\Http\Controllers\frontend\CartController;
use App\Http\Controllers\frontend\CategoryController as FrontendCategoryController;
use App\Http\Controllers\frontend\CheckoutController;
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\frontend\OrderController;
use App\Http\Controllers\frontend\PaymentController;
use App\Http\Controllers\frontend\ProductController as FrontendProductController;
use App\Http\Controllers\frontend\UserController;
use App\Models\Order;
use App\Models\PaymentMethod;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Laravel\Socialite\Facades\Socialite;

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

Route::get('/test', function () {
    echo $_SERVER['REMOTE_ADDR'];
});

# frontend routes
Route::get('/a', function () {
    abort(500);
});


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/privacy-policy', [HomeController::class, 'privacyPolicy'])->name('privacy_policy');

Route::get('/terms-and-conditions', [HomeController::class, 'termsAndConditions'])->name('terms_and_conditions');

Route::get('/return-policy', [HomeController::class, 'returnPolicy'])->name('return_policy');

Route::get('/about-us', [HomeController::class, 'aboutUs'])->name('about_us');

Route::get('/contact-us', [HomeController::class, 'contactUs'])->name('contact_us');





// Account

Route::get('/login', [UserController::class, 'showFormLogin'])->name('login');

Route::post('/login', [UserController::class, 'login']);

Route::get('/register', [UserController::class, 'showFormRegister'])->name('register');

Route::post('/register', [UserController::class, 'register']);

Route::get('/logout', [UserController::class, 'logout'])->name('logout');

// Social Login

Route::get('/auth/google', function () {
    return Socialite::driver('google')->redirect();
});

Route::get('/auth/google/callback', function () {
    $user = Socialite::driver('google')->user();
    dd($user);
    // $user->token
});


// Product

Route::get('/product/{slug}-{code}.html', [FrontendProductController::class, 'productDetails'])
    ->where('slug', '[a-zA-Z0-9\-]+')->name('product_detail');

Route::get('/search', [FrontendProductController::class, 'search'])->name('search');

Route::post('/products/add-product-to-cart', [FrontendProductController::class, 'addProductToCart'])->name('add_product_to_cart');

// Cart


Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'cart'])->name('cart');
    Route::post('/cart/add-product-to-cart', [CartController::class, 'addProductToCart'])->name('add_product_to_cart');
    Route::post('/cart/remove-product-from-cart', [CartController::class, 'removeProductFromCart'])->name('remove_product_from_cart');


    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::get('/get-districts', [CheckoutController::class, 'getDistricts']);
    Route::get('/get-wards', [CheckoutController::class, 'getwards']);



    Route::get('/orders', [OrderController::class, 'index'])->name('order');
    Route::post('/orders/process', [OrderController::class, 'processOrder'])->name('process_order');
    Route::get('/orders/{order_code}', [OrderController::class, 'orderDetail'])->name('order_detail');
    Route::get('/confirm-order/{order_code}/{token}', [OrderController::class, 'confirmOrder'])->name('confirm_order');
    Route::post('/resend-order-confirmation-email', [OrderController::class, 'resendOrderConfirmationEmail'])->name('resend_order_confirmation_email');
    Route::post('/orders/cancel-order', [OrderController::class, 'cancelOrder'])->name('cancel_order');

    Route::get('/payment/success', [PaymentController::class, 'paymentSuccess'])->middleware('check.order.in.progress')->name('payment.success');

    Route::get('/payment/vnpay/return', [PaymentController::class, 'vnpayReturn'])->name('payment.vnpay.return');

    Route::get('/payment/paypal/return', [PaymentController::class, 'paypalReturn'])->name('payment.paypal.return');
    Route::get('/payment/paypal/cancel', [PaymentController::class, 'cancelReturn'])->name('payment.paypal.cancel');

    Route::get('/user', [UserController::class, 'user'])->name('user');
});

// Category
Route::get('/categories/{slug}', [FrontendCategoryController::class, 'showProductsInCategory'])->name('category_products');
Route::get('/ajax/categories/filter', [FrontendCategoryController::class, 'filter']);






# backend routes

Route::middleware(['auth', 'auth.admin'])->prefix('/admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/dashboard/get-chart-data', [DashboardController::class, 'getChartData']);

    Route::resource('/categories', CategoryController::class);
    Route::post('/categories/delete', [CategoryController::class, 'delete'])->name('delete_category');

    Route::resource('/products', ProductController::class);
    Route::post('/products/delete', [ProductController::class, 'delete'])->name('delete_product');
    Route::post('/products/set-featured-product', [ProductController::class, 'setFeaturedProduct'])->name('set_featured_product');

    Route::resource('/profile', ProfileController::class);

    Route::resource('/orders', BackendOrderController::class);
    Route::post('/orders/update-order-status', [BackendOrderController::class, 'updateOrderStatus'])->name('update_order_status');
    Route::get('/order/filter', [BackendOrderController::class, 'filterOrder'])->name('filter_orders_by_status');

    Route::resource('/users', BackendUserController::class);
});

Route::middleware(['auth', 'auth.admin'])->group(
    function () {
        Route::get('/users/export', [BackendUserController::class, 'export'])->name('export_user');
        Route::get('/order/export', [BackendOrderController::class, 'export'])->name('export_order');
    }
);

Route::get('/admin/login', [AdminController::class, 'showFormLogin'])->name('admin_login');

Route::post('/admin/login', [AdminController::class, 'authenticate']);

Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin_logout');

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
