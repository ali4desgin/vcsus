<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HttpRequest extends Model
{
    //


   
    public static function postCurl($url, $data = array()) {
        $fields = '';
        foreach ($data as $key => $value) {
            $fields .= $key . '=' . $value . '&';
        }
        rtrim($fields, '&');

        $post = curl_init();

        curl_setopt($post, CURLOPT_URL, $url);
        curl_setopt($post, CURLOPT_POST, count($data));
        curl_setopt($post, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($post, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($post);

        curl_close($post);
        return json_decode($result);
    }


    
   
   


    public static function sendVerSms($phone=""){

        $code = rand(1000,9999);
        //die(public_path().'/validation/sms/'.time().".txt");
        $myfile = fopen( public_path().'/validation/sms/'.time().".txt", "w") or die("Unable to open file!");
        
        $txt = "your verification code is : ".$code;
        fwrite($myfile, $txt);
       fclose($myfile);

        return $code;
    }

    
}
