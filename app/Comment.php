<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $table = 'comment';


    public static function getCommentsCount($post_id){
        return self::where("post_id","=",$post_id)->count();
    }
}
