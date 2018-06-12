<?php

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


Route::group(['prefix'=>'admin', 'middleware'=>'auth'],function(){
   
   
Route::get('/', 'adminController@index');
    // Route::get('/products','productsController@index')->name('products');
    // Route::get('/products/create','productsController@create')->name('create-product');
    // Route::get('/products/create/image/{id}','productsController@createProductImages')->name('create-product-images');
Route::resource('products','productsController');
Route::get('product/create/{id}','ProductsController@createImagesPage')->name('addImg');
Route::post('product/storeimages','ProductsController@storeImages');
Route::get('categories','catBrandController@index');
Route::get('/product/delete/{id}', 'productsController@destroy');
Route::get('/product/show/{id}', 'productsController@showProduct');
Route::get('/categories/delete/{id}', 'catBrandController@destroy');
Route::get('/brand/delete/{id}', 'catBrandController@destroyBrand');
Route::get('/brand/report','catBrandController@brandReport');

// pos routes

Route::get('pos/sales','posController@index');
Route::post('pos/submitSale','posController@submitSale')->name('pos.submitSale');
Route::get('pos/getItemDetail/{id}','posController@getItemDetail');
Route::get('pos/getColors/{id}/{size}','posController@getColors');
Route::get('pos/generateReceipt/{bill}', 'posController@generateReceipt')->name('pos.generateReceipt');
Route::post('/storeCat','catBrandController@storeCat');
Route::post('/storeBrand','catBrandController@storeBrand');
Route::get('/getPropucts','productsController@getProducts')->name('get.products');
//----bill----
Route::get('/bills','billController@index');
Route::get('/bills/delete/{id}', 'billController@destroy');
Route::get('/bills/show/{id}', 'billController@show');
Route::post('/bills/update','billController@update');

//---end bill --------

// ----- report -----

Route::get('/reports','reportsController@index');
Route::get('/reports/summaryReport','reportsController@summary');
Route::post('/reports/summaryReport/getReport', 'reportsController@getreport');


//---customer---

Route::post('customer/submit', 'CustomerController@submit');

//--- end customer ---

});
//Route::post('/addcat','catBrandController@storeCat');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/',function(){
    return redirect()->route('login');
});
