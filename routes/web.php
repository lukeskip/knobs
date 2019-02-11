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
    return view('sweet.song_list');
});

Auth::routes();


Route::get('/pago', function () {
    return view('sweet.payment');
});

// Route::get('/login', function () {
//     return view('sweet.login');
// });

Route::resource('/songs', 'SongController');
Route::resource('/reviews', 'ReviewController');

Route::get('/reviews/create/{song}', 'ReviewController@create');






Route::get('/home', 'HomeController@index')->name('home');

Route::get('login/{provider}',          'Auth\SocialAccountController@redirectToProvider');
Route::get('login/{provider}/callback', 'Auth\SocialAccountController@handleProviderCallback');
