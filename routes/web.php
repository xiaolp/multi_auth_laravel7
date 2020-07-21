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

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', function () {
    return view('welcome');
});


Route::post('/users/logout', 'Auth\LoginController@logout')->name('logout');

Route::prefix('admin')->group(function() {

    Route::group(['middleware' => 'guest:admin'], function () {
        Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
        Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
      });


    Route::group(['middleware' => 'auth:admin'], function () {
         Route::get('/', 'AdminController@index')->name('admin.dashboard');
     });

  Route::post('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');

});

