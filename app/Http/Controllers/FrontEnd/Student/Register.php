<?php

namespace App\Http\Controllers\FrontEnd\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Session;
use \App\University,\App\HttpRequest,\App\Student , \App\Profile,\App\Helper,\App\Faculty, \App\City, \App\Image;

class Register extends Controller
{

    public function start(Request $request){


        $validator = [];

        $validatedData = $request->validate([
           // 'stud_email' => 'required|max:255|unique:students',
            'university_id' => 'required',
            ///'stud_number' => 'required|min:4|unique:students'
        ]);



       $university =  University::where([
            ['id','=',$request->input("university_id")],
            ['uni_status','=',0]

        ])->first();
        if(empty($university)){

            $validator[] = "الجامعة المختارة غير صالحة ";
            return redirect("/")->withErrors($validator);
        }


        if(!filter_var($request->input("stud_email"),FILTER_VALIDATE_EMAIL)){

            $validator[] = "الايميل غير صالح ";
            return redirect("/")->withErrors($validator);
        }




        $postData = array(

            'stud_number'=> $request->input("stud_number")
        );

       // $university->uni_validation_api;
        $res =  HttpRequest::postCurl("http://localhost/webserivce/http_request.php", $postData);
     


        if($res->error==1){

            $validator[] = $res->message;
            return redirect("/")->withErrors($validator);
           
     }else{


       
           // send sms message to phone number to check it
            $phone = $res->data->phone; // $res->data->phone

            $code  =  HttpRequest::sendVerSms( $phone);

            $stud_ob = new Student;
            $stud_ob->stud_email = $request->input("stud_email");
            $stud_ob->stud_phone = $phone;
            $stud_ob->verification_code = $code;
            $stud_ob->stud_uni_id = $request->input("university_id");
            $stud_ob->stud_number = $request->input("stud_number");//$request->input("stud_number")


            $stud_ob->save();


          

            $student = Student::where("stud_email",'=',$request->input("stud_email"))->select("id","stud_phone","stud_uni_id")->orderBy("id","desc")->first();

            $pro_ob = new Profile;
            $pro_ob->stud_id = $student->id;
            $path =  'usersdata/profile_images/'.$student->id;
            //return $path ;

           // return $student->id;
            mkdir('usersdata/profile_images/'.$student->id);
            $pro_ob->save();

           // $request->session()->remove('id');
           Session::put("id",$student->id);
           Session::put("registered",1);

           //return $student->stud_uni_id;
           Session::put("unversity_id",$student->stud_uni_id);
           Session::put("phone",$student->stud_phone);
/*
            $request->session()->put('id', $student->id);
            $request->session()->put('registered', 1);
            $request->session()->put('unversity_id', $student->stud_uni_id  );
            $request->session()->put('phone', );
    */
            return redirect("register/verify");
     }








        return redirect("/");

    }






    public function verify(Request $request){

       if(Session::get("registered") != 1 ){

            return redirect("/");
       }


       





       if($request->method()=="POST"){

            $verification_code = $request->input("verification_code");

            $student_id = Session::get("id");
            $validatedData = $request->validate([
                'verification_code' => 'required|min:4|max:6'
            ]);



            $student = Student::where("id","=",$student_id)->first();

            $database_ver_code = $student->verification_code;
            

           // return $student

            if( $database_ver_code == $verification_code ){

                Session::put('registered', 2);
                    return redirect("/register/final");
            }else{

                $validator[] =" Verfication Code Are Not Valid";
                return redirect("/register/verify")->withErrors($validator);


            }


       }





       $pho = Session::get("phone");
       $phone = "*****" . Helper::SubStrWithLen($pho, 5);



       return view("FrontEnd.Login.verfiy",compact("phone"));


    } 



    public function final(Request $request){
        if(Session::get("registered") != 2 ){

            return redirect("/");
       }




       $university_id =  Session::get("unversity_id");
       $student_id =  Session::get("id");

       if($request->method()=="POST"){


            $validatedData = $request->validate([
                'faculty_id' => 'required',
                'city_id' => 'required',
                'password' => 'required|min:6|max:200',
                'confrim_password' => 'required|min:6|max:200'
            ]);


            $city_count = City::where(
                    [
                        ["id","=",$request->input("city_id")]
                        ,
                        ["pos_status","=",0]
                    
                    ]

            )->count();

            $faculty_count = Faculty::where(
                [
                    ["id","=",$request->input("faculty_id")]
                    ,
                    ["facl_status","=",0]
                    ,
                    ["uni_id","=", $university_id]
                
                ]

            )->count();


            if($city_count <= 0){
                $validator[] =" Please Choose valid city";
                return redirect("/register/final")->withErrors($validator);

            }

            if($faculty_count <= 0){

                $validator[] =" Please Choose valid Faculty";
                return redirect("/register/final")->withErrors($validator);
            }


            $password = $request->input("password");
            $confrim_password = $request->input("confrim_password");

            if($password !== $confrim_password){

                $validator[] =" Password doesn't match Confrim password";
                return redirect("/register/final")->withErrors($validator);

            }

            


            Student::where("id","=",$student_id)->update(
                ['stud_pos_id' => $request->input("city_id") , 'stud_facl_id' => $request->input("faculty_id"), 'stud_password' => $request->input("password"),"stud_status"  => 0]
            

            );


            Session::put('registered', 3);


            return redirect("/register/last");






       }



       
       $data = [];

        //return  $university_id;
        $data['faculties'] =  Faculty::where([["uni_id",'=',$university_id],["facl_status","=",0]])->get()->toArray();

        $data['cities'] = City::where("pos_status","=",0)->orderBy("id","desc")->get()->toArray();


        return view("FrontEnd.Login.complete",compact("data"));
    }




    public function last(Request $request){
        if(Session::get("registered") != 3 ){

            return redirect("/");
       }



      
       Session::put('logged', 1);




       if($request->method()=="POST"){
            $student_id =  Session::get("id");

            $day = $request->input("day");
            $month = $request->input("month");
            $year = $request->input("year");
            $profile_image  = $request->file("profile_image"); 

            $datestamp = strtotime("$year-$month-$day");
            $date = date("d/m/Y",$datestamp);
           
            $image = "";
            if (!empty($profile_image) and in_array($profile_image->getClientOriginalExtension() , array("png","jpg","jpeg","gif"))) {
            
            
                    $current_time_stamp = time();
                    $uploaded_name = $current_time_stamp.".".$profile_image->getClientOriginalExtension();

                    $path = public_path().'/usersdata/profile_images/'.Session::get("id");
                    $profile_image->move($path,$uploaded_name);


//return $profile_image->getSize();
                    $image = $uploaded_name;
                    $imageOb = new Image;
                    $imageOb->stud_id = $student_id;
                    $imageOb->img_type = 0;
                    //$imageOb->img_size = $profile_image->getClientSize();
                    $imageOb->img_path = $image ;
        
                    $imageOb->save();
                
            }



            $social_status = $request->input("social_status");



            Profile::where("stud_id","=",$student_id)->update(
                ['stud_social_status' => $social_status , 'stud_brith_day' => $date , "stud_profile_img" => $image ]
            

            );


           return  redirect("/home");

       }

       return view("FrontEnd.Login.last");


    }





}
