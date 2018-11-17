<?php

namespace App\Http\Controllers\FrontEnd\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
class Logout extends Controller
{
    //


    public function logout(){


        Session::flush();


        return redirect("/");
    }


}
