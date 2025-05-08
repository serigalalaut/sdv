<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Session;

class LoginBasic extends Controller
{
  public function index()
  {
    return view('content.authentications.auth-login-basic');
  }
  public function login(Request $request){
    $request->validate([
      'email' => 'required',
      'password' => 'required',
    ]);
   
    $credentials = $request->except(['_token']);

        if (auth()->attempt($credentials)) {
            return redirect()->route('home');
        }
    
    return redirect("/auth/login")->withSuccess('Login details are not valid');
    
  }

    /**
     * Handle response after user authenticated
     * 
     * @param Request $request
     * @param Auth $user
     * 
     * @return \Illuminate\Http\Response
     */
    protected function authenticated(Request $request, $user) 
    {
        return redirect()->intended();
    }

    public function logout(Request $request){
      Session::flush();

      Auth::logout();
 
        return redirect('/auth/login');
    }
}
