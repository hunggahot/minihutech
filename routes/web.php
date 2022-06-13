<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

//frontend
Route::get('/', [HomeController::class, 'index']);
Route::get('/homepage', 'App\Http\Controllers\HomeController@index'); // gọi hàm index từ controller ra trang chủ

//homepage category product
Route::get('/category-product/{category_id}', 'App\Http\Controllers\CategoryProduct@show_category_home'); 

//backend (admin)
Route::get('/admin', 'App\Http\Controllers\AdminController@index');
Route::get('/dashboard', 'App\Http\Controllers\AdminController@show_dashboard');
Route::get('/logout', 'App\Http\Controllers\AdminController@logout');
Route::post('/admin-dashboard', 'App\Http\Controllers\AdminController@dashboard');

//category product
Route::get('/add-category-product', 'App\Http\Controllers\CategoryProduct@add_category_product');
Route::get('/edit-category-product/{category_product_id}', 'App\Http\Controllers\CategoryProduct@edit_category_product');
Route::get('/delete-category-product/{category_product_id}', 'App\Http\Controllers\CategoryProduct@delete_category_product');
Route::get('/all-category-product', 'App\Http\Controllers\CategoryProduct@all_category_product');

Route::get('/unactive-category-product/{category_product_id}', 'App\Http\Controllers\CategoryProduct@unactive_category_product');
Route::get('/active-category-product/{category_product_id}', 'App\Http\Controllers\CategoryProduct@active_category_product');

Route::post('/update-category-product/{category_product_id}', 'App\Http\Controllers\CategoryProduct@update_category_product');
Route::post('/save-category-product', 'App\Http\Controllers\CategoryProduct@save_category_product');

//brand product
Route::get('/add-brand-product', 'App\Http\Controllers\BrandProduct@add_brand_product');
Route::get('/edit-brand-product/{brand_product_id}', 'App\Http\Controllers\BrandProduct@edit_brand_product');
Route::get('/delete-brand-product/{brand_product_id}', 'App\Http\Controllers\BrandProduct@delete_brand_product');
Route::get('/all-brand-product', 'App\Http\Controllers\BrandProduct@all_brand_product');

Route::get('/unactive-brand-product/{brand_product_id}', 'App\Http\Controllers\BrandProduct@unactive_brand_product');
Route::get('/active-brand-product/{brand_product_id}', 'App\Http\Controllers\BrandProduct@active_brand_product');

Route::post('/update-brand-product/{brand_product_id}', 'App\Http\Controllers\BrandProduct@update_brand_product');
Route::post('/save-brand-product', 'App\Http\Controllers\BrandProduct@save_brand_product');

//product
Route::get('/add-product', 'App\Http\Controllers\Product@add_product');
Route::get('/edit-product/{product_id}', 'App\Http\Controllers\Product@edit_product');
Route::get('/delete-product/{product_id}', 'App\Http\Controllers\Product@delete_product');
Route::get('/all-product', 'App\Http\Controllers\Product@all_product');

Route::get('/unactive-product/{product_id}', 'App\Http\Controllers\Product@unactive_product');
Route::get('/active-product/{product_id}', 'App\Http\Controllers\Product@active_product');

Route::post('/update-product/{product_id}', 'App\Http\Controllers\Product@update_product');
Route::post('/save-product', 'App\Http\Controllers\Product@save_product');