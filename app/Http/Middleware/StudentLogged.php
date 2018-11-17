<?php

namespace App\Http\Middleware;

use Closure;
use Session;
class StudentLogged
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


        if(Session::has("logged") and Session::has("logged") == 1){


            return redirect("/home");
        }


        
        return $next($request);
    }
}
