<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

//frontend
Route::get('/', [HomeController::class, 'index']);
Route::get('/homepage', 'App\Http\Controllers\HomeController@index'); // gọi hàm index từ controller ra trang chủ


//backend (admin)
Route::get('/admin', 'App\Http\Controllers\AdminController@index');
Route::get('/dashboard', 'App\Http\Controllers\AdminController@show_dashboard');
Route::get('/logout', 'App\Http\Controllers\AdminController@logout');
Route::post('/admin-dashboard', 'App\Http\Controllers\AdminController@dashboard');

//category product
Route::get('/add-category-product', 'App\Http\Controllers\CategoryProduct@add_category_product');
Route::get('/all-category-product', 'App\Http\Controllers\CategoryProduct@all_category_product');