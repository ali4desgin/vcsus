<?php

namespace App\Http\Controllers\FrontEnd\Fourm;
use session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \App\Fourm,\App\Post,\App\Comment;
class Department extends Controller
{
    public function index($fourm_id ,Request $request){

         $current_student_id = Session::get("id");
        $fourms =  Fourm::getStudentFourms($current_student_id);
        $fourm = Fourm::where([["id",$fourm_id],["four_status",0],["four_type",2]])->first();
        
       
 


        if(empty($fourm)){
            return back();
        }



        $posts = Post::where([["post_type",2],["four_id",$fourm_id],["post_status",0]])->orderBy("id","desc")->get();

        return view("FrontEnd.Fourm.department",compact("fourm","posts","fourms"));
    }

}
