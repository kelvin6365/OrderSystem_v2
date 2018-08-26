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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/adminhome', 'AdminHomeController@index')->name('adminhome');

Route::prefix('adminorder_list')->group(function() {
	Route::get('/', 'AdminOrderController@order_list')->name('adminorder_list');
	//Route::get('/edit', 'AdminOrderController@adminorder_edit')->name('adminorder_edit');
	Route::get('/delete{id}', 'AdminOrderController@delete_item')->name('delete_item','{id}');
	Route::get('/Search/{id}', 'AdminOrderController@SearchProduct')->name('adminorder_searchProduct','{id}');

});
Route::get('/adminorder_list/{id}{case}', 'AdminOrderController@action')->name('order_action','{id}','{case}');
Route::post('/adminorder_list/{id}{case}', 'AdminOrderController@action')->name('post','{id}','{case}');

Route::prefix('adminorder')->group(function() {

	Route::get('/', 'AdminOrderController@index')->name('adminorder');
	Route::post('/', 'AdminOrderController@test_event')->name('adminorder_send');
	Route::get('/Search/{id}', 'AdminOrderController@SearchProduct')->name('adminorder_searchProduct','{id}');
  });
