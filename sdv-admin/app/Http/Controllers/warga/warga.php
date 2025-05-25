<?php

namespace App\Http\Controllers\warga;

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


class Warga extends Controller
{
  public function index(Request $request)
  {
    
    $warga = DB::table('warga')
      ->select('*')
      ->orderBy('no_rumah','ASC')
      ->get();

    return view('content.warga.warga',[
      "warga"=> $warga, 
    ]);
  }

  public function details($id)
  {
    $warga = DB::table('warga')
      ->select('*')
      ->where('id',$id)
      ->first();

    return view('content.warga.details',["data"=> $warga]);
  }

  public function edit($id)
  {
    $warga = DB::table('warga')
      ->select('*')
      ->where('id',$id)
      ->first();

    return view('content.warga.edit',["data"=> $warga]);
  }

  public function update(Request $request)
  {
    $warga = DB::table('warga')
      ->where('id',$request->id)
      ->update([
        'no_rumah' => $request->no_rumah,
        'nama_suami' => $request->nama_suami,
        'nama_istri' => $request->nama_istri,
        'no_suami' => $request->no_suami,
        'no_istri' => $request->no_istri,
        'status' => $request->status,
        'no_ktp' => $request->no_ktp,
        'no_kk' => $request->no_kk,
        'alamat_ktp' => $request->alamat_ktp,
      ]);

    return redirect('/warga')->with('success','Data Berhasil Di Update');
  }
}
