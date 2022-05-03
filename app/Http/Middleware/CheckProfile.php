<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth as Auth;
use Closure;

class CheckProfile
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        $role = get_role();
        if($role == 'critic'){
            if($user->profiles){
                return $next($request); 
           }else{
                return redirect('/profiles/create/');
           }
        }else{
            return $next($request);
        }
        
    }
}
