<?php

namespace App\Http\Controllers;

use App\Rating;
use App\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth as Auth;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        echo $hola;
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
        $user = Auth::user();
        $role = $user->roles->first()->name;


        if($role == 'critic'){
           return response()->json(['success' => false,'message'=>'No puedes calificar los Knobs porque eres un crítico']); 
        }


        // Registramos las reglas de validación
        $rules = array(
            'rating'         => 'required|integer',
            'review_id'       => 'required|integer',       
        );

        // Validamos todos los campos
        $validator = Validator::make($request->all(), $rules);

        $review_id        = $request->review_id;
        $score            = $request->rating;

        // Si la validación falla, nos detenemos y mandamos false
        if ($validator->fails()) {
            return response()->json(['success' => false,'message'=>'Hay campos con información inválida, por favor revísalos']);
        }

        $rating_check = Rating::where('review_id',$review_id)->where('user_id',$user->id)->first();

        $review = Review::find($review_id);


        if($review->songs->users->id == $user->id){

            if(!$rating_check){
                $rating = new Rating;
                $rating->score         = $score;
                $rating->review_id     = $review_id;
                $rating->user_id       = $user->id;
                $rating->save();

                return response()->json(['success' => true,'message'=>'Gracias por calificar este knob']);
            // Si si la actualizamos 
            }else{

                $rating_check->score       = $score;
                $rating_check->save();

                return response()->json(['success' => true,'message'=>'Gracias por re calificar este knob']);
            }  
        } else{
            return response()->json(['success' => false,'message'=>'No puedes calificar este knob']);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function show(Rating $rating)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function edit(Rating $rating)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rating $rating)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rating $rating)
    {
        //
    }

}
