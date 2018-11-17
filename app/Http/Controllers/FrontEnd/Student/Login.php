<?php

namespace App\Http\Controllers\FrontEnd\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \App\University,\App\Student;
use Illuminate\Support\Facades\Hash;



class Login extends Controller
{



    public function index(){



        $universities = University::where('uni_status','=',0)->get();

        $data['universities'] = $universities;
        //return  DB::table('admin')->first()->toArray();
 
         return view("FrontEnd.Login.index", compact("data"));
 
     }




     public function login(Request $request){




        if($request->method()!="POST"){

            return redirect("/");
        }



        $validatedData = $request->validate([
            'email' => 'required|max:255',
            'password' => 'required|min:6',
        ]);



       // $password = md5($request->input("password")) ;
        $password = $request->input("password");
        $email = $request->input("email");



       // return $password;
        

        $student = Student::where([
            ['stud_email','=',$email],
            ['stud_password','=',$password],
            ['stud_status','=',0]
        ])->select('id', 'stud_phone')->first();


        if(empty($student)){


            return redirect("/");

        }else{

                //return  $student;


                
                $request->session()->put('id', $student->id);
                $request->session()->put('phone', $student->stud_phone);
                $request->session()->put('logged', 1);

                return redirect("/home");


        }

     }
 
}
