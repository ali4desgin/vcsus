<?php
namespace App\Http\Controllers\Frontend\Lib;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Library;
use \App\Student;
use \App\Post;


class Lib extends Controller
{
   public function index(){
  // $check_student =  Student::where([["id","=",$student_id],["stud_status","=",0]])->count();
   
   $libarary=Library::get();



        if(isset($_GET['view'])){
                switch($_GET['view']){

                 case 'latest':
                 $libarary = Library::where("file_status","=",0)->orderBy("id","desc")->limit(80)->get();
                 break;

                 case 'word':
                 $libarary = Library::where("file_type","=",'docx')->orderBy("id","desc")->limit(80)->get();
                 break;

                 case 'powr':
                 $libarary = Library::where("file_type","=",'pptx')->orderBy("id","desc")->limit(80)->get(); 
                   

                 break;


                 case 'book':
                 $libarary = Library::where("file_type","=",'pdf')->orderBy("id","desc")->limit(80)->get(); 
                 break;
                 
                 case 'viduo':
                 $libarary = Library::where("file_type","=",'viduo')->orderBy("id","desc")->limit(80)->get(); 
                 break;

              
                        

                                       

                default:
                $libarary = Library::where("file_type","=",'pdf')->orderBy("id","desc")->limit(80)->get(); 
                }

                  } 
            

 	return view("FrontEnd.lib.lib",compact("libarary"));
    }







     public function getDownload($id)
    {
      $file = Library::get("../resources/logs/$id");
      $headers = array(
           'Content-Type: application/octet-stream',
      );
      #return Response::download($file, $id. '.' .$type, $headers); 
      return response()->download($file, $id.'txt', $headers);
    }

}


 