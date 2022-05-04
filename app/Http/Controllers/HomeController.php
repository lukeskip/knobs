<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;

class HomeController extends Controller
{
    

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $profiles = Profile::where('status','approved')->where('vip',true)->get();
        $price = get_option('price');
        return view('sweet.home',compact(['price','profiles']));
    }
}
