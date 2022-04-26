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

Auth::routes();

// LANDING PAGE
Route::get('/', function () {
	$price = App\Option::where('slug','price')->first()->value;
    return view('sweet.home')->with('price',$price);
});

Route::get('/registrate-como-productor', function () {
    return view('sweet.home_critic');
})->name('critic-landing');

Route::get('/reviews/{review}', 'ReviewController@show');

Route::get('/notice_privacy/', function(){
	return view('sweet.notice_privacy');
});

Route::get('/terms/', function(){
	return view('sweet.terms');
});

// STARTS:ROUTE HOOK PAYMENTS CONFIRMATION
Route::post('/confirmed_oxxo','PaymentController@confirmation')->name('conekta_webhook');
Route::post('/confirmed_paypal','PaymentController@confirmation_paypal')->name('paypal_webhook');
// ENDS:ROUTE HOOK PAYMENTS CONFIRMATION

Route::group(['middleware' => ['auth']], function () {
	Route::post('/upload/image', 'FileController@image');
	Route::post('/upload/mp3', 'FileController@mp3');
	Route::resource('/profiles', 'ProfileController');
	
	Route::get('/dashboard', 'DashboardController@show_musician');
	
	// LOG OUT
	Route::get('/logout', function () {
    	Auth::logout();
		return redirect('/');
	});

	// REDIRECTS BY ROLES
	Route::get('/redirects', function () {
		// if(get_role() == 'admin'){
		// 	return redirect('/admin/dashboard');
		// }elseif(get_role() == 'critic'){
		// 	return redirect('/critic/dashboard');
		// }elseif(get_role() == 'musician'){
		// 	return redirect('/songs');
		// }
		return redirect()->intended();
	});
});


// STARTS: ROUTES FOR LOGGED USERS AND CHECK FOR CRITICS FOR PROFILES
Route::group(['middleware' => ['auth','check_profile']], function () {

	Route::resource('/payments', 'PaymentController')->except(['show','create']);
	
	Route::get('/payments/create/{song}', 'PaymentController@create');
	Route::get('/payments/{order_id}', 'PaymentController@show');
	Route::resource('/songs', 'SongController');
	Route::resource('/payments', 'PaymentController')->except(['index']);
	Route::resource('/comments', 'CommentController');
	Route::resource('/ratings', 'RatingController');
	Route::resource('/guests', 'GuestController');
	Route::post('/redimir', 'CouponController@redeem')->name('redeem');
	

	//Payment Oxxo Post
	Route::post('/oxxo', 'PaymentController@CreatePayOxxo'); 

	
});
// ENDS: ROUTES FOR LOGGED USERS


 

// STARTS: ROUTES JUST FOR ADMIN
Route::group(['middleware' => ['auth','admin','check_profile'],'prefix'=>'admin'], function () {
	Route::get('/users','AdminController@users' );
	Route::post('/users/role','AdminController@users_role' );
	Route::get('/songs/','AdminController@songs' );
	Route::get('/payments/users','AdminController@payment_users' );
	Route::resource('/options', 'OptionController');
	Route::resource('/reviews', 'ReviewController');
	Route::resource('/admin_comments', 'AdminCommentController');
	Route::get('/dashboard', 'DashboardController@show');
	Route::get('/payments', 'PaymentController@index');
	Route::resource('/coupons', 'CouponController',['names' => 'coupons']);
	

	

});
// ENDS: ROUTES JUST FOR ADMIN


// STARTS: ROUTES JUST FOR CRITICS AND ADMIN
Route::group(['middleware' => ['auth','critic','check_profile']],function () {
	Route::resource('/reviews', 'ReviewController',['except' => ['show','create']]);
	Route::get('/critic/dashboard', 'DashboardController@show_critic');
	Route::get('/reviews/create/{song}', 'ReviewController@create');
});
// ENDS: ROUTES JUST FOR CRITICS AND ADMIN


// Home
Route::get('/home', function () {
	return redirect('/');
});

// Home
Route::get('/phpinfo', function () {
	phpinfo();
});

Route::get('login/{provider}',          'Auth\SocialAccountController@redirectToProvider');
Route::get('login/{provider}/callback', 'Auth\SocialAccountController@handleProviderCallback');
