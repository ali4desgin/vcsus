<?php

namespace App\Http\Controllers\FrontEnd\Profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \App\Student;
use \App\Profile;
class Home extends Controller
{
    //


    public function index($student_id){
        $check_student =  Student::where([["id","=",$student_id],["stud_status","=",0]])->count();
        $check_profile =  Profile::where([["stud_id","=",$student_id]])->count();
        if($check_student<=0 || $check_profile <= 0){

           return redirect("/home");
        }



        $info = Student::getFullProfile($student_id);
    

       // return $student_id;

       return view("FrontEnd.Profile.index",compact("info"));
    
    }
}
