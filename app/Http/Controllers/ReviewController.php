<?php

namespace App\Http\Controllers;

use App\Review;
use App\Song;
use App\Score;
use App\Category;
use Illuminate\Support\Facades\Auth as Auth;
use Illuminate\Http\Request;

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
        }else if(Auth::user()->roles->first()->name == 'admin'){
            $reviews = Review::where('user_id',Auth::user()->id)->paginate();
        }else{
            return abort(404);
        }

        foreach ($reviews as $review) {
            $review['knob']      = '/reviews/'.$review->id;
            $review['knob_edit'] = '/reviews/'.$review->id.'/edit';
        }

        return view('sweet.reviews_list')->with('reviews',$reviews);
        
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
        $fields          = array_merge($request->all());
        $scores_ids      = array();
        
        foreach ($fields as $key => $field) {
            if($key == 'status'){
                $review->status = $field;
            }else if($key == 'song_id'){
                $song = Song::find($field);
            }else{
            
                $category           = Category::where('slug',$key)->first();
                $score              = new Score;
                $score->score       = $field;
                $category->scores()->save($score);
                $scores_ids[]= $score->id;  
            }
            
        }

        $song->reviews()->save($review);
        
        Score::whereIn('id', $scores_ids)
        ->update([
            'review_id' => $review->id,
        ]);

        return response()->json(['message'=>'hola','success'=>true,'redirect'=>'/reviews'], 200); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
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
    public function edit(Review $review)
    {
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

        return view('sweet.review_edit')->with('review',$review)->with('knobs',$knobs)->with('form_items',$form_items);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Review $review)
    {


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
        

        return response()->json(['message'=>'Tu knob se guardó correctamente','success'=>true,'redirect'=>'/reviews'], 200);
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
