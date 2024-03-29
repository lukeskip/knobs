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
Route::get('/', 'HomeController@index');

Route::get('/registrate-como-productor', function () {
    return view('sweet.home_critic');
})->name('critic-landing');

Route::get('/reviews/{token}', 'ReviewController@show')->name('review-show');


Route::get('/notice_privacy/', function(){
	return view('sweet.notice_privacy');
});


Route::get('/eliminacion/', function(){
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
	Route::resource('/profiles', 'ProfileController')->except([
		'index','destroy'
	]);
	
	Route::get('/dashboard', 'DashboardController@show_musician');
	
	// LOG OUT
	Route::get('/logout', function () {
    	Auth::logout();
		return redirect('/');
	});

	// REDIRECTS BY ROLES
	Route::get('/redirects', function () {
		if(get_role() == 'admin'){
			return redirect('/admin/dashboard');
		}elseif(get_role() == 'critic'){
			return redirect('/critic/dashboard');
		}elseif(get_role() == 'musician'){
			if(redirect()->intended()->getTargetUrl() == route('profiles.create')){
				return redirect()->intended();
			}else{
				return redirect('/songs');
			}
		}
	});
});


// STARTS: ROUTES FOR LOGGED USERS
Route::group(['middleware' => ['auth']], function () {

	Route::resource('/payments', 'PaymentController')->except(['show','create']);
	
	Route::get('/payments/create/{song}', 'PaymentController@create');
	Route::get('/payments/{order_id}', 'PaymentController@show')->name('payment-show');
	Route::get('/reviews/{token}', 'ReviewController@show')->name('review-show');
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
	Route::resource('/admin_comments', 'AdminCommentController');
	Route::get('/dashboard', 'DashboardController@show')->name('admin-dashboard');
	Route::get('/payments', 'PaymentController@index');
	Route::resource('/coupons', 'CouponController',['names' => 'coupons']);
	Route::resource('/profiles', 'ProfileController')->only(['index','destroy']);
	Route::post('/profile-update-status/{profile}', 'ProfileController@edit_status')->name('update-status');
	Route::resource('/reviews', 'ReviewController',['only' => ['index']]);

});
// ENDS: ROUTES JUST FOR ADMIN


// STARTS: ROUTES JUST FOR CRITICS AND ADMIN
Route::group(['middleware' => ['auth','critic']],function () {
	Route::resource('/reviews', 'ReviewController',['only' => ['create']]);
	Route::get('/reviews/{token}/edit', 'ReviewController@edit');
	Route::put('/reviews/{token}', 'ReviewController@update');
	Route::get('/critic/dashboard', 'DashboardController@show_critic');
	Route::get('/reviews/create/{song}', 'ReviewController@create');
});
// ENDS: ROUTES JUST FOR CRITICS AND ADMIN


// Home
Route::get('/home', function () {
	return redirect('/');
});

// phpinfo
Route::get('/phpinfo', function () {
	phpinfo();
});

// text mail
Route::get('/test-mail', function () {
	sending_mails('contacto@chekogarcia.com.mx', $subject = 'Tu recibo de pago Knobs',array('title' => 'Tu recibo de pago','link' => 'payments/','message_str' => 'Tu pago se llevó a cabo correctamente puedes revisarlo en cualquier momento desde tu dashboard o dando click en el siguiente enlace'), $template = 'receipt');
});

Route::get('login/{provider}',          'Auth\SocialAccountController@redirectToProvider');
Route::get('login/{provider}/callback', 'Auth\SocialAccountController@handleProviderCallback');
