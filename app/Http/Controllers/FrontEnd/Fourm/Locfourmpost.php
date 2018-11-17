<?php

namespace App\Http\Controllers\FrontEnd\Fourm;
use Session;
use \App\Post,\App\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Locfourmpost extends Controller
{
   
    public function create(Request $request){

        $validatedData = $request->validate([
            'content' => 'required|max:200|min:1'
        ]);

/*
>getClientOriginalExtension()
>getClientSize()
move($path,$uploaded_name)
*/
        $images = $request->file("image");


        
        


        $post = $request->input("content");
        $forum_id = $request->input("frm_id");
        $stud_id = Session::get("id");
        $post_type = 1;


        $ob = new Post;
        $ob->stud_id = $stud_id;
        $ob->post_type =$post_type;
        $ob->four_id = $forum_id;
        $ob->content = $post;

        $ob->save();

       // $path =  'usersdata/profile_images/'.$student->id;
            //return $path ;

           // return $student->id;
        mkdir('usersdata/posts/'.$ob->id);

     //   return $ob->id;


     if(!empty($images)){

        foreach($images as $image){


            
            $datestamp = rand(100,9999).time();
            $name = $datestamp.'.'.$image->getClientOriginalExtension();


            $path = public_path().'/usersdata/posts/'.$ob->id;
            $image->move($path,$name);


            $img = new Image;
            $img->stud_id = Session::get('id');
            $img->post_id = $ob->id;
            $img->img_path = $name;
            //$img->img_size = $image->getClientSize();
            $img->img_type = 1;

        //    $size = $image->getClientSize();
        //    $type = $image->getClientOriginalExtension();
        //    echo $type;

        $img->save();
        }
    }




         return back();
    }
    
}

