<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth as Auth;

use Closure;

class Critic
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
        $role = Auth::user()->roles->first()->name;

        if($role == 'admin'){
            return $next($request);
        }else {
            return redirect('/');
        }
    }
}
