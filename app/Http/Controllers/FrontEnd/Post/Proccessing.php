<?php

namespace App\Http\Controllers\FrontEnd\Post;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use \App\Post,\App\Image,\App\Comment;
class Proccessing extends Controller
{
    //

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
        $forum_id = 0;
        $stud_id = Session::get("id");
        $post_type = 0;


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


    public function delete($post_id){


        Post::where("id",$post_id)->delete();
        return back();
        

    }
    



    public function edit(Request $request ){


        $postid = $request->input("post_id");
        $content = $request->input("content");


        Post::where("id",$postid)->update(["content"=> $content]);


        return back();
        

    }



    public function view($post_id){

        $post = Post::where("id",$post_id)->first();
        $comments = Comment::where("post_id",$post_id)->get();
        $comments_count = Comment::where("post_id",$post_id)->count();
        return view("FrontEnd.Post.view", compact("post","comments","comments_count"));
    }


    function addcomment($post_id, Request $request){


        $stud_id = Session::get('id');
        $content = $request->input("content");
        

        $comment = new Comment;
        $comment->post_id = $post_id;
        $comment->stud_id = $stud_id;
        $comment->content = $content;
        $comment->save();
        
        return back();
    }
}
