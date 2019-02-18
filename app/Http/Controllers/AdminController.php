<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\User as User;
use App\Role as Role;
use App\Song as Song;

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

    public function users_role(Request $request){
    	
        $user = User::where('id',$request->user_id)->first();
        $user->roles()->sync([$request->role]);
       	return response()->json(['success' => true,'message'=>'El Rol fue cambiado con éxito a']);

    }
}
