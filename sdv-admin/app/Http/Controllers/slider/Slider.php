<?php

namespace App\Http\Controllers\slider;

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


class Slider extends Controller
{
  public function index()
  {
    $slider = DB::table('slider as s')
      ->select('s.*','mf.filename')
      ->leftJoin('media_file as mf', 'mf.id','=','s.media_file_id')
      ->orderBy('id','DESC')
      ->get();

    return view('content.slider.slider',["slider"=> $slider]);
  }


  public function addSlider(Request $request) {
    
    $file = $request->hasFile('image') ? $request->file('image') : null;
    if ($file != null) {
        $link = $this->UploadBucket($file);
    }
    $media_file_id = DB::table('media_file')->insertGetId([
        "filename" => $link,
        "uploaded_at" => date('Y-m-d H:i:s'),
        "updated_at" => date('Y-m-d H:i:s'),
    ]);

    DB::table('slider')->insertGetId([
      "title" => $request["title"],
      "cta_url" => $request["cta_url"],
      "start_date" => $request["start_date"],
      "end_date" => $request["end_date"],
      "media_file_id" => $media_file_id,
      "enabled" => $request["enabled"],
      "created_at" => date('Y-m-d H:i:s'),
      "updated_at" => date('Y-m-d H:i:s'),
    ]);
    Redis::command('del', ['dgw:slider:list']);
    return redirect('slider/form-slider')->with('success','Data Added Successfully.');
  }

  public function formAddSlider(){
    return view('content.slider.form-add-slider');
  }

  function UploadBucket(UploadedFile $file) {
    $name = Str::random(25);
    $filename= $name . "." . $file->getClientOriginalExtension();
    
    $googleConfigFile = file_get_contents(base_path('dgw-solution-prod-mobile-apps.json'));
    $storage = new StorageClient([
        'keyFile' => json_decode($googleConfigFile, true)
    ]);
    $storageBucketName = config('googlecloud.storage_bucket');
    $bucket = $storage->bucket($storageBucketName);
    $fileSource = fopen($file->getRealPath(), 'r');
    $newFolderName = 'sliders';
    $googleCloudStoragePath = $newFolderName.'/'.$filename;
    
    $bucket->upload($fileSource, [
    //'predefinedAcl' => 'publicRead',
    'name' => $googleCloudStoragePath
    ]);

    $url = "https://storage.googleapis.com/".$storageBucketName."/".$googleCloudStoragePath;
    return $url;
  }

  public function formEditSlider($id)
  {
    
    $slider = DB::table('slider as s')
      ->select('s.*','mf.filename')
      ->join('media_file as mf','mf.id','=','s.media_file_id')->where("s.id",$id)->first();
    
    return view('content.slider.form-edit-slider',["slider"=> $slider]);
  }

  public function editSlider(Request $request) {
    
    DB::table('slider')->where('id',$request["id"])
    ->update([
        "title" => $request["title"],
        "cta_url" => $request["cta_url"],
        "start_date" => $request["start_date"],
        "end_date" => $request["end_date"],
        //"media_file_id" => $media_file_id,
        "enabled" => $request["enabled"],
        "updated_at" => date('Y-m-d H:i:s'),
    ]);
    Redis::command('del', ['dgw:slider:list']);
    return redirect('slider/edit/'.$request["id"])->with('success','Data Updated Successfully.');
  }

  public function deleteSlider($id) {
    DB::table('slider')->where('id', $id)->delete();
    Redis::command('del', ['dgw:slider:list']);
    return redirect('slider')->with('success','Data deleted successfully.');
  }
  

}
