<?php
namespace App\Helpers;

use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Google\Cloud\Storage\StorageClient;

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
    $newFolderName = 'product';
    $googleCloudStoragePath = $newFolderName.'/'.$filename;
    
    $bucket->upload($fileSource, [
    //'predefinedAcl' => 'publicRead',
    'name' => $googleCloudStoragePath
    ]);

    $url = "https://storage.googleapis.com/".$storageBucketName."/".$googleCloudStoragePath;
    return $url;
}