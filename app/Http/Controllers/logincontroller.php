<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// use App\models\detail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\mailController;
use App\Models\User;
use Carbon\Carbon; 

class logincontroller extends Controller
{
    public function loginpage(Request $req){
        
        return view('auth.loginpage');
    }
    public function Register(Request $req){
       
        return view('auth.register');
    }
    public function create(Request $mem){
       
        $mem->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:5|max:20|required_with:confirm_password|same:confirm_password',
            'confirm_password' => 'min:5|max:20'
        ]);

        $user = new User;
        $user->name = $mem->name;
        $user->email = $mem->email;
        $user->password = Hash::make($mem->password);
        $user->verification_code= Hash::make($mem->verification_code);
        $query = $user->save();
        // $query = DB::table('users')
            // ->insert([
            //     'name'=> $mem->name,
            //     'email' => $mem->email,
            //     'password' => Hash::make($mem->password),
            //     'verification_code'=> shal(time())
            // ]);

        if($user != null){
            mailController::sendSignupEmail($user->name, $user->email, $user->verification_code);
            return redirect('loginpage')->with('success','your account has beed created please check your email for verification');
        }
        return redirect()->back()->with('fail','Something went wrong');


        // if($query){
        //     return back()->with('success', 'You have successfuly registered');
        // }
        // else{
        //     return back()->with('fail','something went wrong');
        // }
    }

    public function check(Request $mem){
        $mem->validate([
            'email'=>'required|email',
            'password'=>'required|min:5|max:12'
        ]);

        // $user = User::where('email',"=",$mem->email)->first();
        DB::table('users')
        ->where('email',$mem->email)
        ->update(['verification_code' => Hash::make($mem->verification_code)]);
        
        $user = DB::table('users')
        ->where('email',$mem->email)
        // ->update(['verification_code' => Hash::make($mem->verification_code)])
        ->first();
        // $user->verification_code= Hash::make($mem->verification_code);
        // $user->save();
        

        if($user){
            if(($user->is_verified) == null){
            
                mailController::sendSignupEmail($user->name, $user->email, $user->verification_code);
                return back()->with('fail', 'account is not verified yet!, we have sent you a link please verify your account');
            }
            if(Hash::check($mem->password, $user->password)){
                $mem->session()->put('LoggedUser', $user->id);
                return redirect('profilepage ');
            }
            else{
                return back()->with('fail', 'Invalid Password');
            }
        }
        else{
            return back()->with('fail', 'No account for this email');
        }
        }
    public function profilepage(){
        if(session()->has('LoggedUser')){
            // $user = User::where('id', '=', session('LoggedUser'))->first();
            $user = DB::table('users')
            -> where('id', session('LoggedUser'))
            ->first();
            $data = [
                'LoggedUserInfo'=>$user
            ];

        }
        return view('admin.profilepage', $data);
    }

    public function logoutpage(){
        if(session()->has('LoggedUser')){
            session()->pull('LoggedUser');
            return redirect('loginpage');

        }
        return redirect('loginpage');
    }
    // public function verifyUser(Request $mem){
    //     $verification_code = \Illuminate\Support\Facades\Request::get('code');
    //     $user = User::where(['verification_code'=>$verification_code])->first();
    //     if($user != null)
    //     {
    //         $user->	is_verified = 1;
    //         $user->save();
    //         // return redirect('loginpage');
    //         return redirect('loginpage');
    //     }
    //     return redirect('loginpage')->with('fail','Invalid Verification Code');
    // }


        public function verifyUser(Request $mem){
            $verification_code = \Illuminate\Support\Facades\Request::get('code');
            $user = User::where(['verification_code'=>$verification_code])->first();
            // $user->verification_code = Hash::make($mem->verification_code);
            
            if($user != null)
            {
                $user->	is_verified = 1;
                $user->save();
                DB::table('users')
                ->where('email',$user->email)
                ->update(['verification_code' => Hash::make($user->verification_code)]);
            
                if(session()->has('LoggedUser'))
                {
                    return redirect('busysession')->with('success','your account has been verified, nut session  please login');
                }
                else{
                $mem->session()->put('LoggedUser', $user->id);
                return redirect('profilepage');
                }
                // return redirect('loginpage')->with('success','your account has been verified please login');
            }
            if(session()->has('LoggedUser'))
                session()->pull('LoggedUser');
            return redirect('loginpage')->with('fail','Invalid Verification Code');
        }



    

   }

