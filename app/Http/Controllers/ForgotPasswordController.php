<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB; 
use Carbon\Carbon; 
use Mail;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
  public function getEmail()
  {

     return view('auth.confirm_email');
  }

 public function postEmail(Request $request)
  {
    $request->validate([
        'email' => 'required|email|exists:users',
    ]);

    $user = DB::table('password_resets')
            ->where('email', $request->email)
            ->first();
    if($user ){
        $dt      = Carbon::now();
        // echo($dt->diffInHours($user->created_at)); 
        if($dt->diffInHours($user->created_at) > 24 )
        {
            DB::table('password_resets')->where(['email'=> $request->email])->delete();
            
            $token = Str::random(64);
            DB::table('password_resets')->insert(
            ['email' => $request->email, 'token' => $token, 'created_at' => Carbon::now()] );
        }
        else{
            $token = $user->token;
        }
        
    }
    else{
        $token = Str::random(64);
        DB::table('password_resets')->insert(
            ['email' => $request->email, 'token' => $token, 'created_at' => Carbon::now()] );
    }

    

    Mail::send('mail.verify-email', ['token' => $token], function($message) use($request){
        $message->to($request->email);
        $message->subject('Reset Password Notification');
    });

    return redirect('loginpage')->with('success', 'We have e-mailed your password reset link!');
  }
}