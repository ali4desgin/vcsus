<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \App\Profile,\App\Follower,\App\Post,\App\City,\App\Faculty,\App\Uinversity,\App\Library;
class Student extends Model
{
    //
    protected $table = 'students';


    public static function getFullProfile($id){

        $full = [];



        $stud = self::where("id","=",$id)->first();

        $full['student'] = $stud;
        $full['profile'] = Profile::where("stud_id","=",$id)->first();
        $full['followings'] = Follower::where("follwer_id",$id)->get()->toArray();
        $full['followers'] = Follower::where("follwing_id",$id)->get();
        $full['posts'] = Post::where([["stud_id",$id],['post_status',"=",0]])->orderBy("id","desc")->paginate(50);

        $full["images"] = Image::where("stud_id",$id)->orderBy('id','desc')->limit(10)->get();

        $full['university'] = University::where("id","=",$stud->stud_uni_id)->first();
        $full['fauclty'] = Faculty::where("id","=",$stud->stud_facl_id)->first();
        $full['city'] = City::where("id","=",$stud->stud_pos_id)->first();
        $full['files'] = Library::where("stud_id","=",$id)->paginate(50);
        $follws = $full['followings'];
        $follws[] = $id;
        $full['seg_students'] =  Student::whereNotIn('id', $follws)->inRandomOrder()->limit(5)->get();

        return $full;



    }


    public static function getStudentWithProfile($id){
        $resutlt = [];
        $resutlt['student'] =  self::where("id","=",$id)->first();
        $resutlt['profile'] = Profile::where("stud_id","=",$id)->first();

        return $resutlt;
    }


    public static function getStudent($id){

        return self::where("id","=",$id)->first();

    }

    public static function getActiveStudent($id){

        return self::where([["id","=",$id],['stud_status',"=",0]])->first();

    }
}
