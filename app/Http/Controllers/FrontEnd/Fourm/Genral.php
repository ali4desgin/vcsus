<?php

namespace App\Http\Controllers\FrontEnd\Fourm;

use Illuminate\Http\Request;
use APP\FrontEnd\Images;
use App\Http\Controllers\Controller;
use \App\Fourm,\App\Post,\App\Comment;
use \App\University,\App\HttpRequest,\App\Student , \App\Profile,\App\Helper,\App\Faculty, \App\City,\App\Follower;
use Session;

class Genral extends Controller
{
    //

    public function index($fourm_id ,Request $request){
         $fourm0 = Fourm::where([["four_type",0],["four_status",0]])->count();
         $current_student_id = Session::get("id");
        $fourms =  Fourm::getStudentFourms($current_student_id);    
        $fourm = Fourm::where([["id",$fourm_id],["four_status",0],["four_type",0]])->first();



           

        if(empty($fourm)){
            return back();
        }


$current_student_id = Session::get("id");
        //$student =  Student::getStudent(Session::get("id"));
        // fourm area
        //$forums = [];
        // get all genral fourms
        $fourms =  Fourm::getStudentFourms($current_student_id);

        $followers = Follower::where("follwer_id","=",Session::get('id'))->select("follwing_id")->get()->toArray();

             $posts=Post::get();

                     if(isset($_GET['view'])){
                switch($_GET['view']){

                        case 'old_first':
                            $posts = Post::where("post_status","=",0)->orderBy("id","asc")->get();
                            break;
                        case 'latest':
                            $posts = Post::where("post_status","=",0)->orderBy("id","desc")->get();
                            break;
                        
                        case 'high_views':
                            $posts = Post::where("post_status","=",0)->orderBy("post_views","desc")->get(); 
                            break;

                         

                            default:
                                $posts = Post::where("post_status","=",0)->orderBy("id","desc")->get(); 
                }

        }else{
            $posts = Post::where("post_status","=",0)->orderBy("id","desc")->limit(50)->get();
        }
        
0;


        ///// random students to follow 

        
        $follws[] = Session::get('id');
        //Student::whereNotIn('id', $follws)->inRandomOrder()->limit(5)->get();
        $rand_students = Student::whereNotIn('id', $follws)->inRandomOrder()->limit(5)->get();


        $posts = Post::where([["post_type",0],["four_id",$fourm_id],["post_status",0]])->orderBy("id","desc")->get();

        return view("FrontEnd.Fourm.genral",compact("fourm","posts","rand_students","fourms","fourm0"));
    }
}
