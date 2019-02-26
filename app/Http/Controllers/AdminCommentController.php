<?php

namespace App\Http\Controllers;

use App\AdminComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as Auth;

class AdminCommentController extends Controller
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
        if(get_role() == 'admin'){
            $admin_comment = new  AdminComment;
            $admin_comment->description = $request->description;
            $admin_comment->user_id = Auth::user()->id;
            $admin_comment->review_id = $request->review_id;
            $admin_comment->save();
            return response()->json(['success' => true,'message'=>'El comentario fue guardado']);  
        }else{
            return response()->json(['success' => false,'message'=>'No tienes permisos para hacer un comentario']);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AdminComment  $adminComment
     * @return \Illuminate\Http\Response
     */
    public function show(AdminComment $adminComment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AdminComment  $adminComment
     * @return \Illuminate\Http\Response
     */
    public function edit(AdminComment $adminComment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AdminComment  $adminComment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AdminComment $adminComment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AdminComment  $adminComment
     * @return \Illuminate\Http\Response
     */
    public function destroy(AdminComment $adminComment)
    {
        //
    }
}
