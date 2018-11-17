<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    //
    protected $table = 'follower';


    public static function check_follow($follewer, $following){

            $follow = self::where([['follwer_id','=',$follewer],['follwing_id','=',$following]])->count();


            if($follow>=1){

                return true;
            }


            return false;

    }


}
