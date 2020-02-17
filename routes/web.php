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
    return view('index');
});


Route::get('giris', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('giris', 'Auth\LoginController@login');
Route::get('cikis', 'Auth\LoginController@logout');

Route::get('kayitol', 'Auth\RegisterController@showRegistrationForm')->name('register-form');
Route::post('kayitol', 'Auth\RegisterController@register')->name('register');


Route::get('/home', 'HomeController@index')->name('home');
