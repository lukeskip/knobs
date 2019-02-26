<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payment as Payment;
use App\User as User;
use App\Option as Option;
use App\Song as Song;
use Illuminate\Support\Facades\Auth as Auth;
use Jenssegers\Date\Date;


class DashboardController extends Controller
{
    public function show(){
    	$option_payment_day = Option::where('slug','payment_day')->first()->value;
        
        $today            = Date::now();
    	$next_payment_day = new Date('next '.$option_payment_day);
    	$past_payment_day = new Date('last '.$option_payment_day);
    	$total            = 0;
        $last_week        = $today->sub('7 day');

    	$payments = Payment::whereBetween('created_at',[$past_payment_day,$next_payment_day])->whereIn('status', ['paid', 'completed', 'processed'])->get();

    	foreach ($payments as $payment) {
    		$total += $payment->total;
    	}

        $songs = Song::whereBetween('created_at',[$last_week,$today])->where('status','paid')->doesnthave('reviews')->get();

    	return view('sweet.dashboard',compact('payments','total','songs'));

    }
}
