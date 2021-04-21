<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\facades\Mail;
use App\Mail\signupEmail;
class mailController extends Controller
{
    Public static function sendSignupEmail($name, $email, $verification_code){
        $data=[
            'name'=>$name,
            'verification_code' =>$verification_code
        ];
        Mail::to($email)->send(new signupEmail($data));
    }
}
