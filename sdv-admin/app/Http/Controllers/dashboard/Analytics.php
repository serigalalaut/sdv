<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Analytics extends Controller
{
  public function index()
  {
    if(Auth::check()){
      $period = date('Y-m',strtotime(env('period')));
      $kas_warga = DB::table('kas_warga')->whereRaw("TO_CHAR(period, 'yyyy-mm') = ?", [$period])->sum('nominal');
      $total_warga = DB::table('ipl')->where('status','Lunas')->where('type',1)->whereRaw("TO_CHAR(period, 'yyyy-mm') = ?", [$period])->count();
      $pemasukan =DB::table('ipl')->where('status','Lunas')->where('type',1)->whereRaw("TO_CHAR(period, 'yyyy-mm') = ?", [$period])->sum('nominal');
      $pengeluaran = DB::table('laporan_keuangan')->where('type','pengeluaran')->whereRaw("TO_CHAR(period, 'yyyy-mm') = ?", [$period])->sum('nominal');
      return view('content.dashboard.dashboards-analytics',[
        "kas_warga" => $kas_warga,
        "pemasukan" => $pemasukan,
        "pengeluaran" => $pengeluaran,
        "total_warga" => $total_warga,
      ]);
    }
    return redirect("/auth/login")->withSuccess('You are not allowed to access');
  }
}
