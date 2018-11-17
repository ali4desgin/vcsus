<?php

namespace App\Http\Middleware;

use Closure;
use Session;
class StudentRegistering
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

        if(Session::has("registered") || Session::has("registered") != 0){


            $registered = Session::has("registered");


            if($registered==1){
                return redirect("/register/verify");

            }else if($registered==2){

                return redirect("/register/final");

            }else{
                return redirect("home");
            }
            
        }


        return $next($request);
    }
}
