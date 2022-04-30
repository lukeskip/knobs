<?php
use App\Option;

// Función que regresa el role que tiene asignado el usuario
function get_option($slug){
	return $option = Option::where('slug',$slug)->first()->value;
}