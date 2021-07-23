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
    return view('layout');
});
Route::get('/product','ProductController@index');
Route::post('/addcategory','CategoryController@add');
Route::get('/listcategory','CategoryController@list_category');
Route::get('/selectcategory','CategoryController@option_list_category');
Route::post('/adddvt','DonViTinhController@add');
Route::get('/listdvt','DonViTinhController@list_dvt');
Route::get('/selectdvt','DonViTinhController@option_list_dvt');
Route::post('/addproduct','ProductController@add');
Route::get('/product/{id}','ProductController@detail_product');
Route::post('/editproduct/{id}','ProductController@update');


