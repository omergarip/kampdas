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


Route::get('/', 'HomeController@index')->name('home');


//Event Routes
Route::get('etkinlikler', 'EventsController@index')->name('events.index');
Route::get('etkinlik/olustur', 'EventsController@create')->name('events.create')->middleware('auth');
Route::post('etkinlik', 'EventsController@store')->name('events.store')->middleware('auth');
Route::get('etkinlik/{slug}', 'EventsController@show')->name('events.show')->middleware('auth');
Route::get('etkinlik/{slug}/guncelle', 'EventsController@edit')->name('events.edit')->middleware('auth');
Route::put('etkinlik/{slug}/', 'EventsController@update')->name('events.update')->middleware('auth');
Route::delete('etkinlik/{id}/sil', 'EventsController@destroy')->name('events.delete')->middleware('auth');
Route::post('etkinlik/{slug}/katil', 'EventsController@attend')->name('events.attend')->middleware('auth');

//Event Media Routes
Route::get('etkinlik/{slug}/medya', 'EventsMediaController@create')->name('media.create')->middleware('auth');
Route::post('etkinlik/{slug}/', 'EventsMediaController@store')->name('media.store')->middleware('auth');
