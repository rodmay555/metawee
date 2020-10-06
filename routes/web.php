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



Auth::routes();





Route::get('/admin/user', 'Admin\UserController@index');

Route::get('/receipt/{number_order}','PDFController@pdf');
// fontend


    // welcome
        Route::get('/category{id}','Admin\CategoryController@select_category');
        Route::get('/','Admin\ProductController@search');
        // Route::get('/', 'HomeController@welcome');

        Route::get('/product/{id}','Admin\ProductController@detail');
    // endwelcome

    Route::middleware(['auth'])->group(function(){

        // home
             Route::get('/home', 'HomeController@index')->name('home');
             Route::post('/home/update/{id}','HomeController@update');
             Route::post('/home/update_password/{id}','HomeController@update_password');
        // endhome

    // cart
        Route::get('/cart','CartController@index');
        Route::get('/cart_app/{id}','CartController@app_cart');
        Route::get('/del_cart/{id}','CartController@del_cart');
        Route::get('/cart/increm/{id}','CartController@increm');
        Route::get('/cart/decrem/{id}','CartController@decrem');
        Route::get('/cart_pay/{number_order}','CartController@cart_pay');
        Route::get('/cart_order','CartController@cart_order');
        Route::post('/pay/{number_order}','CartController@pay');
        Route::post('/order_pay','CartController@order_pay');
        Route::post('/pay/editaddress','CartController@editaddress');
        Route::post('/cart/input_number','CartController@input_number');

    // endcart


    // order
         Route::get('/order','OrderController@index');


         Route::get('/admin/order/approve/{number_order}','OrderController@order_approve');
         Route::post('/admin/order/approve/tracking/{number_order}','OrderController@order_tracking');
         Route::get('/admin/order','OrderController@order_search');
         Route::get('/admin/order/status/{status_id}','OrderController@order_search_status_id');
         Route::get('/order/{status_id}','OrderController@order_status');
         Route::get('/order/received/{status_id}','OrderController@order_received');
         Route::get('/order/delete/{number_order}','OrderController@order_delete');

    // endorder
// endfontend


Route::middleware(['verifIsAdmin'])->group(function(){
// admin
    // product
        Route::get('/admin/product', 'Admin\ProductController@index');
        Route::post('/admin/create_product','Admin\ProductController@create_product');
        Route::post('/admin/update_product/{id}','Admin\ProductController@update_product');
        Route::get('/admin/delete_product/{id}/{currentPage}/{itemPage}','Admin\ProductController@delete');
        Route::get('/admin/product_expire','Admin\ProductController@product_expire');
        Route::post('/admin/add_product_exprie/{id}','Admin\ProductController@add_number_product');
        Route::get('/admin/deleteImage/{id}/{imageName}','Admin\ProductController@deleteimage');
    // endproduct

    // category
        Route::get('/admin/category', 'Admin\CategoryController@index');
        Route::post('/admin/create_category','Admin\CategoryController@create_category');
        // Route::post('/admin/create_category','Admin\CategoryController@create_category');
        Route::post('/admin/update_category/{id}','Admin\CategoryController@update_category');
        Route::get('/admin/delete_category/{id}/{currentPage}/{itemPage}','Admin\CategoryController@delete');
    // endcategory

    //delivery_rate
    Route::get('/admin/daily_rate','DeliveryRateController@index');
    Route::post('/admin/add/delivery','DeliveryRateController@create');
    Route::get('/admin/delete/delivery/{id}','DeliveryRateController@delete');
    Route::post('/admin/update_delivery/{id}','DeliveryRateController@edit');
    //enddeliver_rate
// endadmin

    // report
    Route::get('/sales_daily_s','OrderController@sales_daily_s');
    Route::get('/sales_period_s','OrderController@sales_period_s');
    Route::get('/sales_annual_s','OrderController@sales_annual_s');
        Route::get('/sales_daily','OrderController@sales_daily');
        Route::get('/sales_period','OrderController@sales_period');
        Route::get('/sales_annual','OrderController@sales_annual');


    //end

});
});




