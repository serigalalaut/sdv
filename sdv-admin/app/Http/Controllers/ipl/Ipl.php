<?php

namespace App\Http\Controllers\ipl;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Common;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Google\Cloud\Storage\StorageClient;
use Cache;
use Illuminate\Support\Facades\Redis;


class IPL extends Controller
{
  public function index()
  {
    $ipl = DB::table('ipl')
      ->select('*')
      ->orderBy('created_at','DESC')
      ->get();

    $total = DB::table('ipl')->where('status','Lunas')->sum('nominal');
    $total_keamanan = DB::table('ipl')->where('status','Lunas')->sum('keamanan');
    $total_kebersihan = DB::table('ipl')->where('status','Lunas')->sum('kebersihan');
    $total_kas_warga = DB::table('ipl')->where('status','Lunas')->sum('kas_warga');
    return view('content.ipl.ipl',["ipl"=> $ipl, "total"=> $total, "total_keamanan"=> $total_keamanan, "total_kebersihan"=> $total_kebersihan, "total_kas_warga"=> $total_kas_warga]);
  }

  public function details($id)
  {
    $ipl = DB::table('ipl')
      ->select('*')
      ->where('id',$id)
      ->first();

    return view('content.ipl.details',["data"=> $ipl]);
  }

  public function updateStatus($id) {
    
    DB::table('ipl')->where('id',operator: $id)
    ->update([
        "status" => "Lunas",
        "updated_at" => date('Y-m-d H:i:s'),
    ]);
    
    return redirect('/ipl/confirm/'.$id)->with('success','Data Sudah Terkonfirmasi');
  }

}
