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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'LoaderController@index')->name('index');;

Route::post('product/load', ['as' => 'product.load', 'uses' => 'LoaderController@load']);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
