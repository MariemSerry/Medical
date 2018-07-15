<?php

namespace App\Http\Controllers;

use App\Doctor;
use App\Patient;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function Login(Request $request){
        $email=$request->input("email");
        $password=$request->input("password");
        $type=$request->input("type");
        if($type=="doctor"){
            $LoginResponse = Doctor::login($email,$password);
            return response($LoginResponse);

        }
        $LoginResponse= Patient::login($email,$password);
        return response($LoginResponse);


    }
}
