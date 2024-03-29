<?php

namespace App\Http\Controllers;

use App\Review;
use App\Song;
use App\Score;
use App\Category;
use App\Guest;
use App\User;
use Illuminate\Support\Facades\Auth as Auth;
use Illuminate\Http\Request;
use Jenssegers\Date\Date;

class ReviewController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		if(Auth::user()->roles->first()->name == 'critic'){
		   $reviews = Review::where('user_id',Auth::user()->id)->paginate(); 
		   $title = "Tus Knobs";
		}else if(Auth::user()->roles->first()->name == 'admin'){
			$reviews = Review::paginate();
			$title = "Knobs registrados";
		}else{
			return abort(404);
		}

		foreach ($reviews as $review) {
			$review['knob']      = '/reviews/'.$review->id;
			$review['knob_edit'] = '/reviews/'.$review->id.'/edit';
		}

		return view('sweet.reviews_list', array('reviews' => $reviews,'title'=>$title));
		
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create(Song $song)
	{
		$knobs = Category::where('type','knob')->get();
		$form_items = Category::where('type','textarea')->orWhere('type','text')->get();
		return view('sweet.review_create')->with('knobs',$knobs)->with('form_items',$form_items)->with('song',$song);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$review          = new Review;
		$review->user_id = Auth::user()->id;
		$review->token   = get_token();
		$fields          = array_merge($request->all());
		$scores_ids      = array();
		
		foreach ($fields as $key => $field) {
			if($key == 'status'){
				$review->status = $field;
			}else if($key == 'song_id'){
				$song = Song::find($field);
			}else{
				if($fields['status'] == 'draft' || ($fields['status']!= 'draft' && $field != '')){
					$category           = Category::where('slug',$key)->first();
					$score              = new Score;
					$score->score       = $field;
					$category->scores()->save($score);
					$scores_ids[]= $score->id;  
				}
				  
			}
			
		}

		$song->reviews()->save($review);
		
		Score::whereIn('id', $scores_ids)
		->update([
			'review_id' => $review->id,
		]);

		if(get_role() == 'critic'){
			$redirect = '/reviews';
		}else{
			$redirect = '/admin/dashboard';
		}

		if($review->status == 'revision'){
			$admins = User::whereHas('roles',function($query){
				$query->where('name','admin');
			})->get();
			foreach ($admins as $admin) {
				sending_mails($admin->email, $subject = 'Hay una crítica esperando aprobación',array('title' => 'hay una crítica esperando aprobación','message_str' => 'Recuerda que la velocidad y calidad son importante para la experiencia de usuario','link' => 'admin/dashboard','link_label'=>'Ir a dashboard'), $template = 'default');
			}
			
		}

		return response()->json(['message'=>'hola','success'=>true,'redirect'=>$redirect], 200); 
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Review  $review
	 * @return \Illuminate\Http\Response
	 */
	public function show($token)
	{	
		$review = Review::where('token',$token)->first();
		
		if(!Auth::guest() || !isset($_GET['token']) || $review->status == 'draft'){
			$user = Auth::user();
			if(get_role() != 'admin' && ($user->id != $review->user_id && $user->id != $review->songs->users->id) && !isset($_GET['token']) ){
				return abort(403, 'Unauthorized action.');
			}elseif(get_role() == 'musician' && $review->status != 'publish'){
				return abort(403, 'Unauthorized action.');
			}
		}elseif(Auth::guest() && isset($_GET['token']) && $review->guests){

			if($review->guests->token != $_GET['token']){
				return abort(403, 'Unauthorized action.');
			}

			$guest = Guest::where('token',$_GET['token'])->first();
			$guest->hits = $guest->hits + 1;
			$guest->save();
		}
		

		$knobs = collect();
		$form_items = collect();
		foreach ($review->scores as $score) {

			if($score->categories->type == 'knob'){
				$knobs->push($score);
			}else if($score->categories->type == 'textarea'){
				$form_items->push($score);
			}

		}

		
		$spotify        = 'spotify';
		$soundcloud     = 'soundcloud';
		strpos($review->songs->link, $soundcloud);
		if(strpos($review->songs->link, $soundcloud)){
			$review['icon'] = '<i class="fab fa-soundcloud"></i>';
		}else if(strpos($review->songs->link, $spotify)){
			$review['icon'] = '<i class="fab fa-spotify"></i>';
		}

		return view('sweet.review_show')->with('review',$review)->with('knobs',$knobs)->with('form_items',$form_items);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Review  $review
	 * @return \Illuminate\Http\Response
	 */
	public function edit($token)
	{
		$review = Review::where('token',$token)->first();
		if(get_role() != 'admin' &&  ($review->status != 'draft' && $review->status != 'rejected')){
			return redirect('/reviews');
		}
		$knobs = collect();
		$form_items = collect();
		foreach ($review->scores as $score) {
			
			if($score->categories->type == 'knob'){
				$knobs->push($score);
			}else if($score->categories->type == 'textarea'){
				$form_items->push($score);
			}

		}

		foreach ($review->admin_comments as $comment) {
			$comment['date'] = Date::instance($comment->created_at)->diffForHumans();

		}

		$spotify        = 'spotify';
		$soundcloud     = 'soundcloud';
		strpos($review->songs->link, $soundcloud);
		if(strpos($review->songs->link, $soundcloud)){
			$review['icon'] = '<i class="fab fa-soundcloud"></i>';
		}else if(strpos($review->songs->link, $spotify)){
			$review['icon'] = '<i class="fab fa-spotify"></i>';
		}
		
		
		return view('sweet.review_edit',compact(['review','knobs','form_items']));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Review  $review
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $token)
	{
		$review = Review::where('token',$token)->first();
		$fields  = array_merge($request->all());
		
		foreach ($fields as $key => $field) {
			if($key == 'status'){
				$review->status = $field;
			}else{
				$score = Score::where('review_id',$review->id)->whereHas('categories', function ($query) use($key) {
					$query->where('slug', '=', $key);
				})->first();
				$score->update(['score'=>$field]);
			}
			
		}

		$review->save();

		if($review->status == 'revision'){
			$admins = User::whereHas('roles',function($query){
				$query->where('name','admin');
			})->get();
			foreach ($admins as $admin) {
				// We send notification to the admins
				sending_mails($admin->email, $subject = 'Hay una crítica esperando aprobación',array('title' => 'hay una crítica esperando aprobación','message_str' => 'Recuerda que la velocidad y calidad son importante para la experiencia de usuario','link' => route('admin-dashboard'),'link_label'=>'Ir a dashboard'), $template = 'default');
			}
			
		}else if($review->status == 'publish'){
			// We send notification to the song owner
			sending_mails($review->songs->users->email, $subject = 'La crítica de tu canción está lista',array('title' => 'Hemos escuchado tu canción...','message_str' => 'Para poder revisar la crítica da click en el siguiente botón, esperamos que le puedas sacar el mayor provecho.','link' => route('review-show',$review->token),'link_label'=>'Ir a dashboard'), $template = 'default');
		}
		

		return response()->json(['message'=>'Tu knob se guardó correctamente','success'=>true,'redirect'=>'/admin/songs'], 200);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Review  $review
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Review $review)
	{
		//
	}
}
