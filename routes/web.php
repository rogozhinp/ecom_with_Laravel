<?php

use Illuminate\Support\Facades\Auth;
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

// show all products
Route::get('products', ["uses"=>"ProductsController@index", "as" => "allProducts"]);

// Men
Route::get('products/men', ["uses"=>"ProductsController@menProducts", "as" => "menProducts"]);

// Women
Route::get('products/women', ["uses"=>"ProductsController@womenProducts", "as" => "womenProducts"]);

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

// display create Product form
Route::get('admin/createProductForm', ["uses"=>"Admin\AdminProductsController@createProductForm", "as" => "adminEditProductForm"]);

// create new product
Route::post('admin/sendCreateProductForm/', ["uses"=>"Admin\AdminProductsController@sendCreateProductForm", "as" => "adminUpdateProduct"]);


// delete products
Route::get('admin/deleteProduct/{id}', ["uses"=>"Admin\AdminProductsController@deleteProduct", "as" => "adminDeleteProduct"]);




















