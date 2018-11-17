<?php

namespace App\Http\Controllers\FrontEnd\Profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session,\App\Student;
class Edit extends Controller
{
    //

    public function index(){

        $info = Student::getFullProfile(Session::get("id"));
        return view('FrontEnd.Profile.edit',compact("info"));
    }
}
