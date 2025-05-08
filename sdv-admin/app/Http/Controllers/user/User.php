<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Validator;


class User extends Controller
{
  public function index()
  {
    $user = DB::table('users')
      ->select('*')->get();
    return view('content.user.user',["user"=> $user]);
  }

  public function addUser(Request $request) {
    $product = DB::table('users')->insert([
      "name" => $request["name"],
      "email" => $request["email"],
      "password" => bcrypt($request["password"]),
      "created_at" => date('Y-m-d H:i:s'),
      "updated_at" => date('Y-m-d H:i:s'),
    ]);
    return redirect('form-user')->with('success','Data Added Successfully.');
  }

  public function formAddUser(){
    return view('content.user.form-add-user');
  }

  public function formEditUser($id){
    $user = DB::table('users')->where('id',$id)->first();
    return view('content.user.form-edit-user', ["user"=>$user]);
  }

  public function UpdateUser(Request $request){
    DB::table('users')->where("id",$request["id"])
    ->update([
      "name" => $request["name"],
      "email" => $request["email"],
      //"password" => bcrypt($request["password"]),
      "updated_at" => date('Y-m-d H:i:s'),
    ]);
    return redirect('user/edit/'.$request["id"])->with('success','Data Updated Successfully.');
  }

  public function deleteUser($id) {
    //$product = DB::table('users')->where('id', $id)->delete();
    $user = DB::table('users')->where('id',$id)->first();
    DB::table('users')->where("id", $id)
    ->update([
      "email" => "_".$user->email ."_",
      "updated_at" => date('Y-m-d H:i:s'),
    ]);
    return redirect('user')->with('success','Nonaktif User Success.');
  }
}
