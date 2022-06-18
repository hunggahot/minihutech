<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryProduct;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BrandProduct;
use App\Http\Controllers\Product;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CouponController;
use Illuminate\Support\Facades\Route;

//frontend
Route::get('/', [HomeController::class, 'index']);
Route::get('/homepage', [HomeController::class, 'index']); // gọi hàm index từ controller ra trang chủ
Route::post('/search', [HomeController::class, 'search']); 

//homepage category product
Route::get('/category-product/{category_id}', [CategoryProduct::class, 'show_category_home']); 
Route::get('/brand-product/{brand_id}', [BrandProduct::class, 'show_brand_home']); 
Route::get('/product-details/{product_slug}', [Product::class, 'product_details']); 

//category product
Route::get('/add-category-product', [CategoryProduct::class, 'add_category_product']);
Route::get('/edit-category-product/{category_product_id}', [CategoryProduct::class, 'edit_category_product']);
Route::get('/delete-category-product/{category_product_id}', [CategoryProduct::class, 'delete_category_product']);
Route::get('/all-category-product', [CategoryProduct::class, 'all_category_product']);

Route::get('/unactive-category-product/{category_product_id}', [CategoryProduct::class, 'unactive_category_product']);
Route::get('/active-category-product/{category_product_id}', [CategoryProduct::class, 'active_category_product']);

Route::post('/update-category-product/{category_product_id}', [CategoryProduct::class, 'update_category_product']);
Route::post('/save-category-product', [CategoryProduct::class, 'save_category_product']);

//brand product
Route::get('/add-brand-product', [BrandProduct::class, 'add_brand_product']);
Route::get('/edit-brand-product/{brand_product_id}', [BrandProduct::class, 'edit_brand_product']);
Route::get('/delete-brand-product/{brand_product_id}', [BrandProduct::class, 'delete_brand_product']);
Route::get('/all-brand-product', [BrandProduct::class, 'all_brand_product']);

Route::get('/unactive-brand-product/{brand_product_id}', [BrandProduct::class, 'unactive_brand_product']);
Route::get('/active-brand-product/{brand_product_id}', [BrandProduct::class, 'active_brand_product']);

Route::post('/update-brand-product/{brand_product_id}', [BrandProduct::class, 'update_brand_product']);
Route::post('/save-brand-product', [BrandProduct::class, 'save_brand_product']);

//product
Route::get('/add-product', [Product::class, 'add_product']);
Route::get('/edit-product/{product_id}', [Product::class, 'edit_product']);
Route::get('/delete-product/{product_id}', [Product::class, 'delete_product']);
Route::get('/all-product', [Product::class, 'all_product']);

Route::get('/unactive-product/{product_id}', [Product::class, 'unactive_product']);
Route::get('/active-product/{product_id}', [Product::class, 'active_product']);

Route::post('/update-product/{product_id}', [Product::class, 'update_product']);
Route::post('/save-product', [Product::class, 'save_product']);

//cart
Route::get('/show-cart', [CartController::class, 'show_cart']);
Route::get('/show-cart-ajax', [CartController::class, 'show_cart_ajax']);
Route::get('/delete-to-cart/{rowId}', [CartController::class, 'delete_to_cart']);
Route::get('/delete-product-cart/{session_id}', [CartController::class, 'delete_product_cart']);
Route::get('/delete-all-product', [CartController::class, 'delete_all_product']);

Route::post('/save-cart', [CartController::class, 'save_cart']);
Route::post('/add-cart-ajax', [CartController::class, 'add_cart_ajax']);
Route::post('/update-cart-qty', [CartController::class, 'update_cart_qty']);
Route::post('/update-cart', [CartController::class, 'update_cart']);

//coupon
Route::post('/check-coupon', [CartController::class, 'check_coupon']);

Route::get('/insert-coupon', [CouponController::class, 'insert_coupon']);
Route::get('/list-coupon', [CouponController::class, 'list_coupon']);

Route::post('/insert-coupon-code', [CouponController::class, 'insert_coupon_code']);

//payment
Route::get('/login-checkout', [CheckoutController::class, 'login_checkout']);
Route::get('/logout-checkout', [CheckoutController::class, 'logout_checkout']);
Route::get('/checkout', [CheckoutController::class, 'show_checkout']);
Route::get('/payment', [CheckoutController::class, 'payment']);

Route::post('/add-customer', [CheckoutController::class, 'add_customer']);
Route::post('/login-customer', [CheckoutController::class, 'login_customer']);
Route::post('/save-checkout', [CheckoutController::class, 'save_checkout']);
Route::post('/order-place', [CheckoutController::class, 'order_place']);

//send mail
Route::get('/send-mail', [HomeController::class, 'send_mail']);

//login facebook
Route::get('/login-facebook', [AdminController::class, 'login_facebook']);
Route::get('/admin/callback', [AdminController::class, 'callback_facebook']);

//login google
Route::get('/login-google', [AdminController::class, 'login_google']);
Route::get('/google/callback', [AdminController::class, 'callback_google']);

//admin
Route::get('/admin', [AdminController::class, 'index']);
Route::get('/dashboard', [AdminController::class, 'show_dashboard']);
Route::get('/logout', [AdminController::class, 'logout']);
Route::post('/admin-dashboard', [AdminController::class, 'dashboard']);

//order
Route::get('/manage-order', [CheckoutController::class, 'manage_order']);
Route::get('/view-order/{orderId}', [CheckoutController::class, 'view_order']);