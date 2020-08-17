<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('kayit-ol', 'API\AuthController@register');
Route::post('giris-yap', 'API\AuthController@login');

Route::apiResource('etkinlik', 'API\EventsController')->middleware('auth:api')->except(['index']);
Route::get('etkinlikler', 'API\EventsController@index');
Route::post('etkinlik/{slug}/katil', 'API\EventsController@attend')->name('events.attend')->middleware('auth:api');
Route::post('etkinlik/{slug}/ayril', 'API\EventsController@detach')->name('events.leave')->middleware('auth:api');

Route::get('etkinlikler/bu-hafta', 'EventsController@eventsInWeek')->name('events.eventsInWeek');
Route::get('etkinlikler/bu-ay', 'EventsController@eventsInMonth')->name('events.eventsInMonth');
Route::get('etkinlikler/gelecekte', 'EventsController@eventsInFuture')->name('events.eventsInFuture');
Route::get('etkinlik/{slug}/bilgileri-al', 'EventsController@apiShow')->name('events.apiShow');


Route::get('profil/{username}/katildigim-etkinlikler', 'UserProfileController@userEvents')->name('profile.userEvents');
