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

Auth::routes();
Route::prefix('admin')->group(function(){
	Route::get('login', 'Auth\AdminLoginController@login')->name('admin.auth.login');
	Route::post('login', 'Auth\AdminLoginController@loginAdmin')->name('admin.login');
	Route::post('logout', 'Auth\AdminLoginController@logout')->name('admin.auth.logout');
	Route::get('dashboard', 'AdminController@getDashboard')->name('admin.dashboard');
	Route::get('register', 'Auth\AdminRegisterController@showRegisterForm')->name('admin.register');
	Route::post('register', 'Auth\AdminRegisterController@store')->name('admin.auth.register');

	Route::get('secure', 'AdminController@showSecureForm');
	Route::post('secure', 'AdminController@validateSecure')->name('post.secure');

});

Route::get('/home', 'HomeController@index')->name('home');
