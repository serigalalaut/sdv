<?php

namespace App\Http\Controllers\keuangan;

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


class Keuangan extends Controller
{
  public function KasWarga(Request $request)
  {
    $period = $request->period;
    if($period == ""){
      $period = date('Y-m');
    }
    $kas_warga = DB::table('kas_warga')
      ->select('*')
      ->whereRaw("TO_CHAR(period, 'yyyy-mm') = ?", [$period])
      ->orderBy('period','DESC')
      ->get();

    
    $total = DB::table('kas_warga')->whereRaw("TO_CHAR(period, 'yyyy-mm') = ?", [$period])->sum('nominal');
    
    return view('content.keuangan.kas_warga',[
      "kas_warga"=> $kas_warga, 
      "total"=> $total,
    ]);
  }

  public function KasWargaAdd(Request $request)
  {
    return view('content.keuangan.kas_warga_add');
  }

  public function KasWargaAddPost(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'judul' => 'required',
      'nominal' => 'required',
    ]);

    if ($validator->fails()) {
      return redirect()->back()->with('error', 'Data gagal ditambahkan');
    }

    $data = [
      'title' => $request['judul'],
      'nominal' => $request['nominal'],
      'note' => $request['keterangan'],
      'period' => date('Y-m-01'),
      'created_at' => date('Y-m-d H:i:s'),
      'updated_at' => date('Y-m-d H:i:s'),
    ];  
    DB::table('kas_warga')->insert($data);

    return redirect()->back()->with('success', 'Data berhasil ditambahkan');
  }

  public function Pengeluaran(Request $request)
  {
    $period = $request->period;
    if($period == ""){
      $period = date('Y-m');
    }
    $pengeluaran = DB::table('laporan_keuangan')
      ->select('*')
      ->whereRaw("TO_CHAR(period, 'yyyy-mm') = ?", [$period])
      ->where('type','pengeluaran')
      ->orderBy('period','DESC')
      ->get();

    $total = DB::table('laporan_keuangan')->where('type','pengeluaran')->whereRaw("TO_CHAR(period, 'yyyy-mm') = ?", [$period])->sum('nominal');

    return view('content.keuangan.pengeluaran',[
      "pengeluaran"=> $pengeluaran, 
      "total"=> $total,
    ]);
  }     

  public function PengeluaranDetails(Request $request)
  {
    $id = $request->id;
    $pengeluaran = DB::table('laporan_keuangan')->where('id',$id)->first();
    return view('content.keuangan.pengeluaran_detail',[
      "data"=> $pengeluaran, 
    ]);
  }

  public function PengeluaranAdd(Request $request)
  {
    return view('content.keuangan.pengeluaran_add');
  }

  public function PengeluaranAddPost(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'bukti_pengeluaran' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      'nama_pengeluaran' => 'required',
      'nominal' => 'required',
      'transaction_date' => 'required',
    ]);
    if ($validator->fails()) {
      return redirect()->back()->with('success', 'Data gagal ditambahkan');
    }
    $imagePath = $request->file('bukti_pengeluaran')->store('images/pengeluaran', 'public');
    
    $data = [
      'media_file' => $imagePath,
      'title' => $request['nama_pengeluaran'],
      'nominal' => $request['nominal'],
      'note' => $request['keterangan'],
      'period' => date('Y-m-01'),
      'type' => 'pengeluaran',
      'transaction_date' => $request['transaction_date'],
      'created_at' => date('Y-m-d H:i:s'),
      'updated_at' => date('Y-m-d H:i:s'),
    ];
    DB::table('laporan_keuangan')->insert($data);

    return redirect()->back()->with('success', 'Data berhasil ditambahkan');
  }

  public function Pemasukan(Request $request)
  {
    $period = $request->period;
    if($period == ""){
      $period = date('Y-m');
    }
    $pemasukan = DB::table('laporan_keuangan')
      ->select('*')
      ->whereRaw("TO_CHAR(period, 'yyyy-mm') = ?", [$period])
      ->where('type','pemasukan')
      ->orderBy('period','DESC')
      ->get();

    $total = DB::table('laporan_keuangan')->where('type','pemasukan')->whereRaw("TO_CHAR(period, 'yyyy-mm') = ?", [$period])->sum('nominal');

    return view('content.keuangan.pemasukan',[
      "pemasukan"=> $pemasukan, 
      "total"=> $total,
    ]);
  }

  public function PemasukanDetails(Request $request)
  {
    $id = $request->id;
    $pemasukan = DB::table('laporan_keuangan')->where('id',$id)->first();
    return view('content.keuangan.pemasukan_detail',[
      "data"=> $pemasukan, 
    ]);
  }

  public function PemasukanAdd(Request $request)
  {
    return view('content.keuangan.pemasukan_add');
  }

  public function PemasukanAddPost(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'bukti_pemasukan' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      'nama_pemasukan' => 'required',
      'nominal' => 'required',
      'transaction_date' => 'required',
    ]);
    if ($validator->fails()) {
      return redirect()->back()->with('success', 'Data gagal ditambahkan');
    }
    $imagePath = $request->file('bukti_pemasukan')->store('images/pemasukan', 'public');
    $data = [
      'title' => $request['nama_pemasukan'],
      'nominal' => $request['nominal'],
      'note' => $request['keterangan'],
      'period' => date('Y-m-01'),
      'type' => 'pemasukan',
      'transaction_date' => $request['transaction_date'],
      'media_file' => $imagePath,
      'created_at' => date('Y-m-d H:i:s'),
      'updated_at' => date('Y-m-d H:i:s'),
    ];
    DB::table('laporan_keuangan')->insert($data);

    return redirect()->back()->with('success', 'Data berhasil ditambahkan');
  }       
  
  
}
