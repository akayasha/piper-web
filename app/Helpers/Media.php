<?php

namespace App\Helpers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

trait Media {

    public function uploads($file, $path)
    {
        if($file && $file->isValid()) {
            $url = url('/');
            $fileExtension = $file->getClientOriginalExtension();
            $customFileName = 'exe_file_' . substr(uniqid(), -10) . '_' . rand(1000, 9999) . '.' . $fileExtension;
            while (Storage::disk('public')->exists($path . $customFileName)) {
                $customFileName = 'exe_file_' . substr(uniqid(), -10) . '_' . rand(1000, 9999) . '.' . $fileExtension;
            }
            Storage::disk('public')->put($path . $customFileName, File::get($file));
            $filePath = $url.'/storage/' . $path . $customFileName;
            return [
                'fileName' => $customFileName,
                'fileType' => $fileExtension,
                'filePath' => $filePath,
                'fileSize' => $this->fileSize($file)
            ];
        }
    }

    public function fileSize($file, $precision = 2)
    {
        $size = $file->getSize();

        if ( $size > 0 ) {
            $size = (int) $size;
            $base = log($size) / log(1024);
            $suffixes = array(' bytes', ' KB', ' MB', ' GB', ' TB');
            return round(pow(1024, $base - floor($base)), $precision) . $suffixes[floor($base)];
        }

        return $size;
    }

    public function removeImage($fileName,$path){
        Storage::disk('public')->delete($path.'/'.$fileName);
    }
}
