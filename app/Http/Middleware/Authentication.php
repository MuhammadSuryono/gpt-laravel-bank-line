<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class Authentication
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
      //if(Session::has('userId'))
      //dd(Session::has('userId'));
      if(!Session::has('userId')){
         return redirect()->route('login');
      }
        return $next($request);
    }
}
