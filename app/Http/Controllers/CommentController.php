<?php

namespace App\Http\Controllers;

use App\Comment as Comment;
use App\Review as Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth as Auth;

class CommentController extends Controller
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
		$user                   = Auth::user();
		$review                 = Review::find($request->review_id); 
		$permission             = false;

		if($user->roles->first()->name == 'critic'){
			
			if($review->users->id == $review->id){
				$permission = true;
			}

		}elseif ($user->roles->first()->name == 'musician') {
			
			if($review->songs->users->id == $review->id){
				$permission = true;
			}

		}elseif ($user->roles->first()->name == 'admin') {
			$permission = true;
		}

		if($permission){
			$comment                = new Comment;
			$comment->description   = $request->description;
			$comment->review_id     = $review->id;
			$comment->user_id       = $user->id;
			$comment->save();
			return response()->json(['success' => true,'message'=>'Tu comentario fue guardado','description'=>$comment->description,'user' => $user->name]);
		}else{
			return response()->json(['success' => false,'message'=>'No tienes permiso para comentar este knob']);
		}
		
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Comment  $comment
	 * @return \Illuminate\Http\Response
	 */
	public function show(Comment $comment)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Comment  $comment
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Comment $comment)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Comment  $comment
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Comment $comment)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Comment  $comment
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Comment $comment)
	{
		//
	}
}
