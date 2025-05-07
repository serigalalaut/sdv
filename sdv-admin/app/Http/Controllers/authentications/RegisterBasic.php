<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use DB;
use Hash;
use Session;

class RegisterBasic extends Controller
{
  public function index()
  {
    return view('content.authentications.auth-register-basic');
  }
  public function register(Request $request) {
        
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:admin.users',
            'password' => 'required|min:6',
        ]);
          
        $data = $request->all();
        $check = $this->create($data);

        return redirect('/')->with('success', "Account successfully registered.");
  }
  public function create(array $data){
    return User::create([
      'name' => $data['name'],
      'email' => $data['email'],
      'password' => Hash::make($data['password'])
    ]);
  }    
}
