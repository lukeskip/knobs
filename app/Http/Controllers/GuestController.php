<?php

namespace App\Http\Controllers;

use App\Guest;
use App\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth as Auth;
use Illuminate\Support\Str;

class GuestController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{	
		$rules = array(
            'review_id'     => 'required|max:255',   
        );

		// Validamos todos los campos
        $validator = Validator::make($request->all(), $rules);

        // Si la validación falla, nos detenemos y mandamos false
        if ($validator->fails()) {
            return response()->json(['success' => false,'message'=>'Hubo un error en el servidor']);
        }

        $user = Auth::user();
        $review = Review::find($request->review_id);

		// ENVIAMOS ERROR Y EL USUARIO NO ES DUEÑO DE LA CANCIÓN
		
		if($review->songs){
			if($review->songs->users->id != $user->id){
				return abort(403, 'Unauthorized action.');
			}
		}else{
			return abort(404, 'File not found');
		}

		        

        // SI EL REVIEW NO TIENE GUESTS REGISTRADOS CREAMOS UNO
		if($review->guests->count() <= 0){
			$guest 				= new Guest;
			$guest->token 	 	= Str::random(15);
			$guest->review_id 	= $request->review_id;
			$guest->hits 		= 0;
			$guest->save();

			return response()->json(['success' => true,'token'=>$guest->token]);
		}else{

			// SI SÍ TIENE GUEST REGISTRADOS LE REGRESAMOS EL TOKEN
			return response()->json(['success' => true,'token'=>$review->guests->token]);

		}

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Guest  $guest
	 * @return \Illuminate\Http\Response
	 */
	public function show(Guest $guest)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Guest  $guest
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Guest $guest)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Guest  $guest
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Guest $guest)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Guest  $guest
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Guest $guest)
	{
		//
	}
}
