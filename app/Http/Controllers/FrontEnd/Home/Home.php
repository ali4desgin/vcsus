<?php

namespace App\Http\Controllers\FrontEnd\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use \App\University,\App\HttpRequest,\App\Student , \App\Profile,\App\Helper,\App\Faculty, \App\City,\App\Fourm, \App\Follower;
use \App\Post;

class Home extends Controller
{
    public function index(Request $request){
        $current_student_id = Session::get("id");
        //$student =  Student::getStudent(Session::get("id"));
        // fourm area
        //$forums = [];
        // get all genral fourms
        $fourms =  Fourm::getStudentFourms($current_student_id);


        $followers = Follower::where("follwer_id","=",Session::get('id'))->select("follwing_id")->get()->toArray();

        if(isset($_GET['view'])){
                switch($_GET['view']){

                        case 'old_first':
                            $posts = Post::where([
                                ["post_status","=",0],
                               [ "post_type","=",0]
                            ])->orderBy("id","asc")->paginate(50);
                            break;
                        case 'latest':
                            $posts = Post::where([
                                ["post_status","=",0],
                               [ "post_type","=",0]
                            ])->orderBy("id","desc")->paginate(50);
                            break;
                        case 'random':
                            $posts = Post::where([
                                ["post_status","=",0],
                               [ "post_type","=",0]
                            ])->inRandomOrder()->paginate(50); 
                            break;
                        case 'high_views':
                            $posts = Post::where([
                                ["post_status","=",0],
                               [ "post_type","=",0]
                            ])->orderBy("post_views","desc")->paginate(50); 
                            break;

                        case 'followers_only':
                       // return Session::get('id');
                            
                            //return $followers;
                            $posts = Post::whereIn("stud_id",$followers)->orderBy("id","desc")->paginate(50); 
                            break;

                            default:
                                $posts = Post::where([
                                    ["post_status","=",0],
                                   [ "post_type","=",0]
                                ])->orderBy("id","desc")->paginate(50); 
                }

        }else{
            $posts = Post::where([
                ["post_status","=",0],
               [ "post_type","=",0]
            ])->orderBy("id","desc")->paginate(50);
        }
        



        ///// random students to follow 

        $follws = $followers;
        $follws[] = Session::get('id');
        //Student::whereNotIn('id', $follws)->inRandomOrder()->limit(5)->get();
        $rand_students = Student::whereNotIn('id', $follws)->inRandomOrder()->limit(5)->get();
       
        //return $rand_students ;


       // return ;
        return view("FrontEnd.Home.index", compact("fourms","posts","rand_students"));
    }
    
}
