<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\models\detail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class reviewController extends Controller
{
    
    function testRequest(Request $req){
        $data = $req->input();
        $req->session()->put('name',$data['user']);
        return redirect('profile');
    }
    

    function add(Request $mem){
        
        
        
        $detail = new detail;
        $detail->username = $mem->username;
        $detail->password = $mem->password;
        $detail->name = $mem->name;
        $detail->email = $mem->email;
        $detail->save();
        $data = $mem->input('name');
        $mem->session()->flash('name',$data);
        return redirect('add');
    }


    function fileupload(Request $doc){
       
       return $doc->file('file')->store('docx');
    }

    function show(){
        $data = detail::all();
        return view('list',['details'=>$data]);
    }
    function delete($id){
        $data = detail::find($id);
        $data->delete();
        return redirect('list');
    }
    function showData($id){
        $data =detail::find($id); 
        // $data->delete();
        // return redirect('list');
        return view('edit',['data'=>$data]); 
    }

    function update(Request $upd){
       
        // return $upd->input();
        $data=detail::find($upd->id);
        $data->username = $upd->username;
        $data->password = $upd->password;
        $data->name = $upd->name;
        $data->email = $upd->email;
        $data->save();
        return redirect('list');

    }
    // function accessor(){
    //     return detail::all();
    // }
    // function mutator(){
    //     $detail=new detail;
    //     $detail->username ="Anjali17";
    //     $detail->password = "17011996";
    //     $detail->name = "Anjali";
    //     $detail->email = "anjali@gmail.com";
    //     $detail->save();
    // }

}

