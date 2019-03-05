<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\User as User;
use App\Role as Role;
use App\Song as Song;
use App\Option as Option;
use App\Review as Review;
use Jenssegers\Date\Date;

class AdminController extends Controller
{
    public function users(){
    	$roles = Role::all();
        $users = User::orderBy('name','ASC');
        if(request()->has('s')){
        	$users->where('name', 'LIKE', '%' . request()->s . '%')->orWhere('email', 'LIKE', '%' . request()->s . '%');
        }
        $users = $users->paginate(15);
        return view('sweet.admin.users')->with('users',$users)->with('roles',$roles);

    }

    public function songs(){
    	$songs = Song::orderBy('title','ASC');
        if(request()->has('s')){
        	$songs->where('title', 'LIKE', '%' . request()->s . '%')->orWhere('author', 'LIKE', '%' . request()->s . '%');
        }
        $songs = $songs->paginate(15);
        return view('sweet.song_list')->with('songs',$songs);

    }

    public function payment_users(){
        $option_payment_day = Option::where('slug','payment_day')->first()->value;
        
        $today            = Date::now();
        $next_payment_day = new Date('next '.$option_payment_day);
        $past_payment_day = new Date('last '.$option_payment_day);
        $total            = 0;
        $last_week        = $today->sub('7 day');

        $users            = User::whereHas('reviews',function($query)use($past_payment_day,$next_payment_day){
                $query->whereBetween('created_at',[$past_payment_day,$next_payment_day]);
        })->get(); 

        foreach ($users as $user) {
            $reviews = $user->reviews->whereBetween('created_at',[$past_payment_day,$next_payment_day]);
            foreach ($reviews as $review) {
                $user['total'] += get_share('critic',$review->payments->method,$review->payments->total);         
            }
        }
        

    

        return view('sweet.user_payment_list',compact('users'));

    }

    public function users_role(Request $request){
    	
        $user = User::where('id',$request->user_id)->first();
        $user->roles()->sync([$request->role]);
       	return response()->json(['success' => true,'message'=>'El Rol fue cambiado con éxito a']);

    }
}
