<?php
use Illuminate\Support\Facades\Auth as Auth;
use App\Option;


// Función que regresa el role que tiene asignado el usuario
function get_share($role,$method, $subtotal){
	$commission 		= 0;
	$options 			= Option::all(); 
	$total				= 0;
	$taxes				= $options->where('slug','taxes')->first()->value;
	$share 				= 0;
	$critic_share  		= $options->where('slug','critic_share')->first()->value;
	$admin_share 		= 100 - $critic_share;

	if($method == 'conekta'){
		$commission = $options->where('slug','conekta_commission')->first()->value;

	}elseif ($method == 'paypal') {
		$commission = $options->where('slug','paypal_commission')->first()->value;
	}

	$taxes = ($subtotal - $commission) * ($taxes * .01);
	$total = ($subtotal - $commission) - $taxes;

	if($role == 'admin'){
		$share = $total * ($admin_share * .01);
	}elseif ($role == 'critic') {
		$share = $total * ($critic_share * .01);
	}

	return $share;
}