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

Route::get('etkinlikler', 'EventsController@apiIndex')->name('events.apiIndex');
Route::get('etkinlikler/bu-hafta', 'EventsController@eventsInWeek')->name('events.eventsInWeek');
Route::get('etkinlikler/bu-ay', 'EventsController@eventsInMonth')->name('events.eventsInMonth');
Route::get('etkinlikler/gelecekte', 'EventsController@eventsInFuture')->name('events.eventsInFuture');
Route::get('etkinlik/{slug}/bilgileri-al', 'EventsController@apiShow')->name('events.apiShow');


Route::get('profil/{username}/katildigim-etkinlikler', 'UserProfileController@userEvents')->name('profile.userEvents');
