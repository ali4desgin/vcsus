<?php

namespace App\Http\Controllers\frontend\File;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Library;
use Session;


class Proce extends Controller
{
  

      public function uplod(Request $request){

        $this->validate($request, [

         'filename' => 'required',
         'filename.*' => 'mimes:docx,3GP,pdf,zip,mp4,mpg,pptx,png,jpg,gif,jpge,PNG']);



         if($request->hasfile('filename'))
         {

            foreach($request->file('filename') as $file)
            {
               
  
                  $stud_id = Session::get("id");
                  $name = $file->getClientOriginalName();
                  $size = $file->getClientSize($name);
                  $path = public_path().'/usersdata/file';
                  $type = $file->getClientOriginalExtension();

                   $file->move($name,$size,$path,$type,$stud_id);  
                //$data[] = $name;  
                

            }

          
         }
       
        $file= new Library();
        $file->stud_id = $stud_id;
        $file->file_title= $name;
        $file->file_path = $path;
        $file->file_size = $size;
        $file->file_type = $type;
        
        $file->save();        
      //mkdir('usersdata/file/'.$file->$stud_id);

        return back()->with('success', 'تم رفع الملف بنجاح');
    


   }



 // public function getDownload()
//{

  //  $file= public_path().'/usersdata/file/';
                


 //   return Response::download($file);
//}



}
