<?php

namespace App\Http\Controllers;

use App\Profile;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as Auth;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profiles = Profile::paginate(20);
        return view('sweet.admin.profiles', compact(['profiles']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $user)
    {
        return view('sweet.profile_create',array('user' => $user));
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
        $rules = array(
            'expertice'     => 'required',
            'picture'       => 'required',
            'summary'       => 'required',
            'genre'         => 'required',
            'name'          => 'required',      
        );

        // Validamos todos los campos
        $validator = Validator::make($request->all(), $rules);

        // Si la validación falla, nos detenemos y mandamos false
        if ($validator->fails()) {
            return response()->json(['success' => false,'message'=>'Hay campos con información inválida, recuerda que todos los campos son obligatorios']);
        }

        $profile            = new Profile;
        $profile->name      = $request->name;
        $profile->expertice = $request->expertice;
        $profile->picture   = $request->picture;
        $profile->summary   = $request->summary;
        $profile->genre     = $request->genre;
        $profile->user_id   = $user->id;
        $profile->phone     = $request->phone;
        $profile->paypal    = $request->paypal;
        $profile->pricing   = $request->pricing;
        $profile->save();

        return response()->json(['success' => true,'message'=>'Tu perfil ha sido guardado','redirect' => '/critic/dashboard']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        return view('sweet.general.not_available');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {   
        $user = Auth::user();
        if(get_role() != 'admin' && $user->id != $profile->user_id){
            return abort(403, 'Unauthorized action.');
        }

        return view('sweet.profile_edit',compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profile $profile)
    {
        $user = Auth::user();
        if(get_role() != 'admin' && $user->id != $profile->user_id){
            return abort(403, 'Unauthorized action.');
        }
    
        $rules = array(
            'expertice'     => 'required',
            'summary'       => 'required',
            'genre'         => 'required', 
            'name'          => 'required',      
        );

        // Validamos todos los campos
        $validator = Validator::make($request->all(), $rules);

        // Si la validación falla, nos detenemos y mandamos false
        if ($validator->fails()) {
            return response()->json(['success' => false,'message'=>'Hay campos con información inválida, recuerda que todos los campos son obligatorios']);
        }

        $profile->name      = $request->name;
        $profile->expertice = $request->expertice;
        $profile->summary   = $request->summary;
        $profile->genre     = $request->genre;
        $profile->phone     = $request->phone;
        $profile->paypal    = $request->paypal;
        $profile->save();

        return response()->json(['success' => true,'message'=>'Tu perfil ha sido guardado','redirect' => '/critic/dashboard']);
    }

    public function edit_status(Request $request, Profile $profile){
        $profile->status = $request->status;
        $profile->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
