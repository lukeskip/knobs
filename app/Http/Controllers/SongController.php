<?php

namespace App\Http\Controllers;

use App\Song;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth as Auth;

class SongController extends Controller
{
    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        if($user->roles->first()->name == 'musician'){
            $songs =  $user->songs;
        }elseif($user->roles->first()->name == 'critic'){
            $songs =  Song::where('status','paid')->get();
        }elseif($user->roles->first()->name == 'admin'){
            $songs =  Song::all();
        }

        foreach ($songs as $song) {
            if($song->reviews){
                $song['knob'] = '/reviews/'.$song->reviews->id;
            }
        }
        
        return view('sweet.song_list')->with('songs',$songs);
        
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sweet.songs.register');
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
            'title'         => 'required|max:255',
            'genre'         => 'required',
            'link'          => 'required', 
            'author'        => 'required|max:255',
            'english'       => 'required|boolean', 
            'description'   => 'required'     
        );

        // Validamos todos los campos
        $validator = Validator::make($request->all(), $rules);

        // Si la validación falla, nos detenemos y mandamos false
        if ($validator->fails()) {
            return response()->json(['success' => false,'message'=>'Hay campos con información inválida, recuerda que todos los campos son obligatorios']);
        }

        $song               = new Song;
        $song->title        = $request->title;
        $song->genre        = $request->genre;
        $song->link         = $request->link;
        $song->author       = $request->author;
        $song->english      = $request->english;
        $song->description  = $request->description;
        $song->status       = 'pending';

       if(!Auth::guest()){
           $user_id = Auth::user()->id;
        }else{
            return response()->json(['success' => false,'message'=>'Necesitas estar loggeado']);
        }

        $user = User::find($user_id);

        $user->songs()->save($song);

        return response()->json(['message'=>'La canción ha sido registrada con éxito','success'=>true,'redirect'=>'/songs'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Song  $song
     * @return \Illuminate\Http\Response
     */
    public function show(Song $song)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Song  $song
     * @return \Illuminate\Http\Response
     */
    public function edit(Song $song)
    {
        return view('sweet.songs.update')->with('song',$song);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Song  $song
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Song $song)
    {   
        $rules = array(
            'title'         => 'required|max:255',
            'genre'         => 'required',
            'link'          => 'required', 
            'author'        => 'required|max:255',
            'english'       => 'required|boolean', 
            'description'   => 'required'     
        );
        // Validamos todos los campos
        $validator = Validator::make($request->all(), $rules);

        // Si la validación falla, nos detenemos y mandamos false
        if ($validator->fails()) {
            return response()->json(['success' => false,'message'=>'Hay campos con información inválida, recuerda que todos los campos son obligatorios']);
        }

        $song->title        = $request->title;
        $song->genre        = $request->genre;
        $song->link         = $request->link;
        $song->author       = $request->author;
        $song->english      = $request->english;
        $song->description  = $request->description;

        $user_id = Auth::user()->id;

        if($song->user_id == $user_id){
            $song->save();
            return response()->json(['message'=>'La canción ha sido actualizada con éxito','success'=>true,'redirect'=>'/songs'], 200);
        }else{
            return response()->json(['message'=>'No puedes editar esta canción','success'=>false,'redirect'=>'/songs'], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Song  $song
     * @return \Illuminate\Http\Response
     */
    public function destroy(Song $song)
    {
        //
    }
}
