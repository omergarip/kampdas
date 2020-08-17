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
Route::get('cikis', 'Auth\LoginController@logout')->name('logout');

Route::get('kayitol', 'Auth\RegisterController@showRegistrationForm')->name('register-form');
Route::post('kayitol', 'Auth\RegisterController@register')->name('register');


Route::get('send', 'MailController@send');

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@redirect');

Route::get('/turkiye-kamp-haritasi', function () {
        return view('map');
})->name('map');


//Event Routes
Route::get('etkinlikler', 'EventsController@index')->name('events.index');
Route::get('etkinlik/olustur', 'EventsController@create')->name('events.create')->middleware('auth');
Route::post('etkinlik', 'EventsController@store')->name('events.store')->middleware('auth');
Route::get('etkinlik/{slug}', 'EventsController@show')->name('events.show')->middleware('auth');
Route::get('etkinlik/{slug}/duzenle', 'EventsController@edit')->name('events.edit')->middleware('auth');
Route::put('etkinlik/{slug}/', 'EventsController@update')->name('events.update')->middleware('auth');
Route::delete('etkinlik/{id}/sil', 'EventsController@destroy')->name('events.delete')->middleware('auth');
Route::post('etkinlik/{slug}/katil', 'EventsController@attend')->name('events.attend')->middleware('auth');
Route::post('etkinlik/{slug}/ayril', 'EventsController@detach')->name('events.leave')->middleware('auth');

//Event Media Routes
Route::get('etkinlik/{slug}/medya', 'EventsMediaController@create')->name('media.create')->middleware('auth');
Route::post('etkinlik/{slug}/', 'EventsMediaController@store')->name('media.store')->middleware('auth');

//Profile Routes
Route::get('profil/{username}', 'UserProfileController@show')->name('profile')->middleware('auth');
Route::get('profil/{username}/guncelle', 'UserProfileController@edit')->name('profile.edit')->middleware('auth');
Route::put('profil/{username}/', 'UserProfileController@update')->name('profile.update')->middleware('auth');
Route::get('profil/{username}/etkinliklerim', 'UserProfileController@showEvents')->name('profile.events')->middleware('auth');

//Notification Routes
Route::get('bildirim/okundu', 'UserNotificationsController@readNotification')->name('notifications.read')->middleware('auth');
Route::get('bildirim/{id}/okundu', 'UserNotificationsController@show')->name('notification.read')->middleware('auth');

//Facebook Login Routes
Route::get('/redirect', 'SocialAuthFacebookController@redirect');
Route::get('/callback', 'SocialAuthFacebookController@callback');

Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    Artisan::call('clear-compiled');
    return "Cache is cleared";
});

