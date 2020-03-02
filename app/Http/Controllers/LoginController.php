<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;

class LoginController extends Controller
{
    public  function logindo(Request $request){
    	$user=$request->except('_token');
    	$user['u_pwd']=md5(md5($user['u_pwd']));
    	$admin=Admin::where($user)->first();
    	if($admin){
    		session(['u_name'=>$admin]);
    		$request->session()->save();

    		return redirect('/student/create');
    	}
    	return redirect('/login')->with('msg','没有此用户');
    }
}
