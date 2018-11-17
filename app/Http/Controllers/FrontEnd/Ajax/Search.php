<?php

namespace App\Http\Controllers\FrontEnd\Ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \App\Post;
class Search extends Controller
{
    //

    public function posts(Request $request){

        $search_text = $request->input("keyword");
        
        $result = [];

        //where('content', 'like', '%$search_text%')
        $result['posts']  = Post::get();
        return   response()->json($result);
    }
}
