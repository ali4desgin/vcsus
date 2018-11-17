<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \App\Student;

class Fourm extends Model
{
    //
    protected $table = 'fourm';


    public static function getStudentFourms($id){


        $student =  Student::getStudent($id);
        $global_fourms = Fourm::where([["four_type","=",0],["four_status","=",0]])->get();



        // get all postion fourm (note that it is just one forum )
        $postion_fourm = Fourm::where([["four_type","=",1],["four_status","=",0],["pos_id","=",$student->stud_pos_id]])->first();


        // get all depart fourm (note that it is just one forum )
        $depart_fourm = Fourm::where([["four_type","=",2],["four_status","=",0],["facl_id","=",$student->stud_facl_id]])->first();

        $forums = [];
        $forums["globals"] =  $global_fourms;
        $forums["postion"] =  $postion_fourm;
        $forums["department"] =  $depart_fourm;

        return $forums;
    }
}
