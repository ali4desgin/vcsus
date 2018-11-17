<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Helper extends Model
{
    //

     
    public static function splitStrWithLen($str, $length){
        
        return str_split($str,$length);
    }
    

    public static function SubStrWithLen($str , $length)
    {
        
        return substr($str,0,$length);
    
    }


    public static function expStrWithChar($str, $char){
        
        return explode($char,$str);
    
    }

    
    public static function getStrLen($str){
        
        return strlen($str);
    
    }
    

    public static  function getSocialStatus($number){

        switch ($number) {
            case 0:
                return "عازب";
                break;
            case 1:
                return "متزوج";
                break;
            case 2:
                return "ارمل";
                break;
            case 3:
                return "مطلق";
                break;
            default:
                return "في علاقة مفتوحة ";
                break;
        }


        return 0;

    } 




    public static  function getStatus($number){

        switch ($number) {
            case 0:
                return "<span class=\"label label-success\">active</span>";
                break;
            case 1:
                return "<span class=\"label label-danger\">blocked</span>";
                break;
            
            default:
                return "unknown";
                break;
        }


    } 



    public static  function getGender($number){

        switch ($number) {
            case 0:
                return "<span class=\"label label-info\">Male</span>";
                break;
            case 1:
                return "<span class=\"label label-info\">Female</span>";
                break;
            
            default:
                return "unknown";
                break;
        }


    } 


    public static function getPostPrivacy($num){

        switch ($num){
            case 0:
                echo "Any one";
                break;

            case 1:
                echo "Folowers ";
                break;


            case 2:
                echo "Only Poster";
                break;


        }

    }
}
