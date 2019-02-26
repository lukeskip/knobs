<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as Auth;
use Illuminate\Support\Str;

class FileController extends Controller
{
    public function image(Request $request){
        $image 			= $request->file('file');
        $image_orig  	= explode('.',$image->getClientOriginalName());
        $ext 			= $image_orig[1];
        $imageName 		= 'profile_'.Auth::user()->id.'.'.$image_orig[1];
        $image->move(public_path('profile_images'),$imageName);
        return response()->json(['file'=>$imageName]);  
 	}

 	public function mp3(Request $request){
        $image 			= $request->file('file');
        $image_orig  	= explode('.',$image->getClientOriginalName());
        $ext 			= 'mp3';
        $song_file_name = $request->song_file_name.'.'.$ext;
     
        
    	$image->move(public_path('song_files'),$song_file_name);
    	return response()->json(['success' => true,'file'=>$song_file_name]); 
        
        
         
 	}

 
}
