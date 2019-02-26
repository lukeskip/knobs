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


// STARTS:ROUTE HOOK PAYMENTS CONFIRMATION
Route::post('/confirmed_oxxo','PaymentController@confirmation')->name('conekta_webhook');
Route::post('/confirmed_paypal','PaymentController@confirmation_paypal')->name('paypal_webhook');
// ENDS:ROUTE HOOK PAYMENTS CONFIRMATION

Route::group(['middleware' => ['auth']], function () {
	Route::post('/upload/image', 'FileController@image');
	Route::post('/upload/mp3', 'FileController@mp3');
	Route::resource('/profiles', 'ProfileController');
});


// STARTS: ROUTES FOR LOGGED USERS
Route::group(['middleware' => ['auth','check_profile']], function () {

	Route::resource('/payments', 'PaymentController');
	Route::get('/payments/create/{song}', 'PaymentController@create');
	Route::get('/payments/receipt/{song}', 'PaymentController@show');
	Route::resource('/songs', 'SongController');
	Route::resource('/payments', 'PaymentController')->except(['index']);
	Route::resource('/comments', 'CommentController');
	Route::resource('/ratings', 'RatingController');
	

	 

	Route::get('/reviews/{review}', 'ReviewController@show');

	//Payment Oxxo Post
	Route::post('/oxxo', 'PaymentController@CreatePayOxxo'); 

	Route::get('/logout', function () {
    	Auth::logout();
		return redirect('/');
	});
});
// ENDS: ROUTES FOR LOGGED USERS




// STARTS: ROUTES JUST FOR ADMIN
Route::group(['middleware' => ['auth','admin','check_profile'],'prefix'=>'admin'], function () {
	Route::get('/users','AdminController@users' );
	Route::post('/users/role','AdminController@users_role' );
	Route::get('/songs/','AdminController@songs' );
	Route::resource('/options', 'OptionController');
	Route::resource('/reviews', 'ReviewController');
	Route::resource('/options', 'OptionController');
	Route::resource('/admin_comments', 'AdminCommentController');
	Route::get('/dashboard', 'DashboardController@show');
	Route::get('/payments', 'PaymentController@index');

	

});
// ENDS: ROUTES JUST FOR ADMIN


// STARTS: ROUTES JUST FOR CRITICS AND ADMIN
Route::group(['middleware' => ['auth','critic','check_profile']],function () {
	Route::resource('/reviews', 'ReviewController',['except' => ['show','create']]);
	Route::get('/dashboard', 'DashboardController@show');
	Route::get('/reviews/create/{song}', 'ReviewController@create');
});
// ENDS: ROUTES JUST FOR CRITICS AND ADMIN


// Route::get('/home', 'HomeController@index')->name('home');

Route::get('login/{provider}',          'Auth\SocialAccountController@redirectToProvider');
Route::get('login/{provider}/callback', 'Auth\SocialAccountController@handleProviderCallback');
