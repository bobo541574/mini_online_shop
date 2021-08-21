<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class UploadFileService
{
    public static function upload(UploadedFile $file, $path)
    {
        $instance = new static;

        return $instance->uploadToStorage($file, $path);
    }

    public static function delete($filename)
    {
        $instance = new static;

        return $instance->uploadFromStorage($filename);
    }

    public function uploadToStorage(UploadedFile $file, $path)
    {
        $imageName = $file->hashName();
        $imageNameArray = explode(".", $imageName);
        $filename = $imageNameArray[0] . "-" . Carbon::now()->format("Y-m-d-g-i-s") . "." . $imageNameArray[1];

        Storage::disk('public')
            ->putFileAs(
                $path,
                $file,
                $filename,
                [
                    'visibility' => 'public',
                    'Cache-Control' => 'public, max-age=2628000'
                ]
            );

        return response()->json([
            'name' => $path . $filename
        ], 200);
    }

    public function uploadFromStorage($filename)
    {
        return Storage::disk('public')->delete($filename);
    }
}
