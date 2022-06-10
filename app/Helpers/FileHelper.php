<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class FileHelper
{
    /**
     * Upload Files To Local Storage
     * @param String $file
     * @param String $folder
     * @param String $disk
     * @return String filepath
     */
    public static function uploadFileBase64($file, $folder, $disk = 'public')
    {
        try {
            // split the string on commas
            // $data[ 0 ] == "data:image/png;base64"
            // $data[ 1 ] == <actual base64 string>
            $data = explode(',', $file);
            $fileName = $folder . "/" . Str::random(10) . (now()->timestamp) . "." . explode("/", explode(';', $data[0])[0])[1]; //generating unique file name;
            Storage::disk($disk)->put($fileName, base64_decode($data[1]));
            return $fileName;
        } catch (\Throwable $th) {
            return null;
        }
    }

    /**
     * Delete Files From The Storage
     * @param String $file
     * @param String $disk     */
    public static function deleteFile($file, $disk = 'public')
    {
        Storage::disk($disk)->delete($file);
    }
}
