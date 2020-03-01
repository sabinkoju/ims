<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminLoginController extends Controller
{

    // Login
    public function login(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            if(Auth::attempt(['email' => $data['email'], 'password' => $data['password']  ])){
                Session::put('adminSession', $data['email']);
                return redirect()->route('admin.dashboard');
            } else {
               return redirect()->route('adminlogin')->with('flash_message_error', 'Invalid Username or Passsword');
            }
        }

        if(empty(Session::has('adminSession'))){
            return view ('admin.login');
        } else {
            return redirect()->route('admin.dashboard');
        }
    }

    // Logout
    public function imsLogout(){
        Session::flush();
        return redirect()->route('adminlogin')->with('flash_message_success', 'Logout Successfull');
    }
}
