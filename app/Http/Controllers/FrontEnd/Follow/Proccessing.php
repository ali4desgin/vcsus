<?php

namespace App\Http\Controllers\FrontEnd\Follow;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \App\Student,\App\Follower;
use Session;
class Proccessing extends Controller
{
    //

    public function follow($following_id){

             $following_id;


             $id = Session::get("id");

             if($id  == $following_id){

                return back();
             }



             $check_student =  Student::where([["id","=",$following_id],["stud_status","=",0]])->count();





             if($check_student<=0){

                return back();
             }

            

             $check_follow = Follower::where([["follwer_id","=",$id],["follwing_id","=",$following_id]])->count();

             if($check_follow>=1){
                return back(); 
                
             }


             




             $ob = new Follower;
             $ob->follwer_id = $id;
             $ob->follwing_id = $following_id;
             $ob->save();



             return back(); 

    }





    public function unfollow($following_id){

        $following_id;


        $id = Session::get("id");

        if($id  == $following_id){

           return back();
        }



        $check_student =  Student::where([["id","=",$following_id],["stud_status","=",0]])->count();





        if($check_student<=0){

           return back();
        }

       

        $check_follow = Follower::where([["follwer_id","=",$id],["follwing_id","=",$following_id]])->count();

        if($check_follow<=0){
           return back(); 
           
        }


        

        Follower::where([["follwer_id","=",$id],["follwing_id","=",$following_id]])->delete();

        return back(); 

}




}
