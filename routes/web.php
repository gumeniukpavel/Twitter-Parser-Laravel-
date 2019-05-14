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

Route::get('/', 'Api\TwitterController@index');
Route::post('/store', 'Api\TwitterController@store');
Route::post('/delete', 'Api\TwitterController@destroy');
Route::post('/refresh', 'Api\TwitterController@refresh');