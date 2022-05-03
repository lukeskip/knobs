<?php
use Illuminate\Support\Facades\Auth as Auth;
use Illuminate\Support\Facades\Log;

// Función que regresa el role que tiene asignado el usuario
function get_role($label = false){
	
	if(!Auth::guest()){
		$user = Auth::user();
		$role = $user->roles()->first()->name;
		if($label){
			$role = ucfirst($role);
		}
		return $role;	
	}
}