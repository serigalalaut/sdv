<?php

namespace App\Http\Controllers\uploads;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class Uploads extends Controller
{
  public function index(Request $request)
  {
    $type = $request->type;
    
      return view('content.authentications.uploads', compact('type'));
    
  }

  public function uploadImage(Request $request){
        // Validate the incoming request
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Max 2MB
            'no' => 'required',
            'type' => 'required',
            'payment_type' => 'required',
        ]);

        // Store the uploaded image
        if ($request->file('image')) {
            $imagePath = $request->file('image')->store('images/ipl', 'public');
            \DB::table('ipl')->insertGetId([
                "id" => Uuid::uuid4()->toString(),
                "media_file" => $imagePath,
                "home_no" => $request["no"],
                "status" => "Pengecekan Admin",
                "nominal" => $request["type"] == 1 ? env('NOMINAL_KEAMANAN_KEBERSIHAN') : env('NOMINAL_KEAMANAN'),
                "kas_warga" => 10000,
                "keamanan" =>  env('KEAMANAN'),
                "kebersihan" => $request["type"] == 1 ? env('KEBERSIHAN') : 0,
                "type" => $request["type"],
                "payment_type" => $request["payment_type"],
                "period" => date('Y-m-01'),
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
              ]);
            return redirect()->back()->with('success', 'Bukti pembayaran berhasil dikirim.');
        }

        return redirect()->back()->with('error', 'Bukti pembayaran gagal dikirim.');
    }

}
