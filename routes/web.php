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
    return view('sweet.home');
});

Auth::routes();




// Route::get('/login', function () {
//     return view('sweet.login');
// });

Route::resource('/songs', 'SongController');
Route::resource('/reviews', 'ReviewController');
Route::resource('/payments', 'PaymentController');

Route::get('/reviews/create/{song}', 'ReviewController@create');
Route::get('/payments/create/{song}', 'PaymentController@create');

Route::post('/oxxo', 'PaymentController@CreatePayOxxo');
Route::post('/confirmed_oxxo','PaymentController@confirmation')->name('conekta_webhook');
Route::post('/confirmed_paypal','PaymentController@confirmation_paypal')->name('paypal_webhook');



Route::get('/home', 'HomeController@index')->name('home');

Route::get('login/{provider}',          'Auth\SocialAccountController@redirectToProvider');
Route::get('login/{provider}/callback', 'Auth\SocialAccountController@handleProviderCallback');
