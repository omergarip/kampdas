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

Auth::routes(['verify' => true]);
Route::get('giris', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('giris', 'Auth\LoginController@login');
Route::get('cikis', 'Auth\LoginController@logout');

Route::get('kayitol', 'Auth\RegisterController@showRegistrationForm')->name('register-form');
Route::post('kayitol', 'Auth\RegisterController@register')->name('register');


Route::get('send', 'MailController@send');

Route::get('/', 'HomeController@index')->name('home')->middleware('verified');

Route::get('/turkiye-kamp-haritasi', function () {
        return view('map');
})->name('map');


//Event Routes
Route::get('etkinlikler', 'EventsController@index')->name('events.index');
Route::get('etkinlikler/olustur', 'EventsController@create')->name('events.create')->middleware('auth');
Route::post('etkinlikler', 'EventsController@store')->name('events.store')->middleware('auth');
Route::get('etkinlikler/{slug}', 'EventsController@show')->name('events.show')->middleware('auth');
Route::get('etkinlikler/{slug}/guncelle', 'EventsController@edit')->name('events.edit')->middleware('auth');
Route::put('etkinlikler/{slug}/', 'EventsController@update')->name('events.update')->middleware('auth');
Route::delete('etkinlikler/{id}/sil', 'EventsController@destroy')->name('events.delete')->middleware('auth');
Route::post('etkinlikler/{slug}/katil', 'EventsController@attend')->name('events.attend')->middleware('auth');
Route::delete('etkinlikler/{slug}/ayril', 'EventsController@detach')->name('events.leave')->middleware('auth');

//Event Media Routes
Route::get('etkinlik/{slug}/medya', 'EventsMediaController@create')->name('media.create')->middleware('auth');
Route::post('etkinlik/{slug}/', 'EventsMediaController@store')->name('media.store')->middleware('auth');

//Facebook Login Routes
Route::get('/redirect', 'SocialAuthFacebookController@redirect');
Route::get('/callback', 'SocialAuthFacebookController@callback');
