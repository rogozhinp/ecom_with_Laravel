<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    return view('test');
});

Route::get('/john', function () {
    return "John String";
});

Route::get('/array', function () {
    $array = ["John", "Mathew", "Susan"];
    return $array;
});

Route::get('products', ["uses"=>"ProductsController@index", "as" => "allProducts"]);

Route::get('product/addToCart/{id}', ["uses"=>"ProductsController@addProductToCart", "as"=>"AddToCartProduct"]);

// show cart items
Route::get('cart', ["uses"=>"ProductsController@showCart", "as"=>"cartProducts"]);

// delete item from cart
Route::get('product/deleteItemFromCart/{id}', ["uses"=>"ProductsController@deleteItemFromCart", "as"=>"DeleteItemFromCart"]);

// User Authentication
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Admin panel
Route::get('admin/products', ["uses"=>"Admin\AdminProductsController@index", "as" => "adminDisplayProducts"]);

// display edit Product form
Route::get('admin/editProductForm/{id}', ["uses"=>"Admin\AdminProductsController@editProductForm", "as" => "adminEditProductForm"]);

// display edit product image form
Route::get('admin/editProductImageForm/{id}', ["uses"=>"Admin\AdminProductsController@editProductImageForm", "as" => "adminEditProductImageForm"]);

// update product image
Route::post('admin/updateProductImage/{id}', ["uses"=>"Admin\AdminProductsController@updateProductImage", "as" => "adminUpdateProductImage"]);

// update product data
Route::post('admin/updateProduct/{id}', ["uses"=>"Admin\AdminProductsController@updateProduct", "as" => "adminUpdateProduct"]);
