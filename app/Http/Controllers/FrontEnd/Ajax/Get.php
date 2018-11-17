<?php

namespace App\Http\Controllers\FrontEnd\Ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \App\Student;
class Get extends Controller
{
    //

    public function student(Request $request){

        $student_id = $request->input('stud_id');
        $student = Student::where('id',$student_id)->first();
        return response()->json($student);
    }



}
