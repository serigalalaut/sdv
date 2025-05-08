<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Analytics extends Controller
{
  public function index()
  {
    if(Auth::check()){
      return view('content.dashboard.dashboards-analytics');
    }
    return redirect("/auth/login")->withSuccess('You are not allowed to access');
  }
}
