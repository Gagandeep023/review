<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\reviewController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\ForgotPasswordController;

use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
}); 
Route::post('users', [reviewController::class,'testRequest']);

Route::post('addmember', [reviewController::class,'add']);
Route::post('uploaded', [reviewController::class,'fileupload']);
// Route::view('login', 'login');
Route::view('profile', 'profile');

Route::get('/login', function () {
    if(session()->has('name'))
    {
        return redirect('profile');
    }
    return view('login');
}); 

Route::get('/logout', function () {
    if(session()->has('name'))
    {
        session()->pull('name');
    }
    return redirect('login');
}); 

Route::view('add', 'add');
Route::view('upload', 'upload');
Route::view('member', 'member');

Route::get('list', [reviewController::class,'show']);

Route::get('/about/{lang}', function ($lang) {
    App::setlocale($lang);
    return view('about');
}); 

Route::get('delete/{id}',[reviewController::class,'delete']);
Route::get('edit/{id}',[reviewController::class,'showData']);
Route::post('edit',[reviewController::class,'update']);

Route::get('accessor',[reviewController::class,'accessor']);
Route::get('mutator',[reviewController::class,'mutator']);


Route::get('loginpage', [loginController::class,'loginpage'])->middleware('alreadyLoggedIn');
Route::get('register', [loginController::class,'Register'])->middleware('alreadyLoggedIn');
Route::post('create', [loginController::class,'create'])->name('auth.create');
Route::post('check', [loginController::class,'check'])->name('auth.check');
Route::get('profilepage', [loginController::class,'profilepage'])->middleware('isLogged');
Route::get('logoutpage', [loginController::class,'logoutpage']);
Route::get('verify', [loginController::class,'verifyUser'])->name('verify.user');
Route::view('dashboard', 'auth.dashboard');
Route::get('/forget-password', [ForgotPasswordController::class,'getEmail']);
Route::post('/forget-password', [ForgotPasswordController::class,'postEmail']);
Route::get('/reset/{token}', [ResetPasswordController::class,'getPassword']);
Route::post('/reset', [ResetPasswordController::class,'updatePassword']);
route::view('busysession', 'auth.busysession');
