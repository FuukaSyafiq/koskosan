<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class DeleteImages
{
    public static function DeleteImages($fileName)
    {
        if ($fileName && Storage::disk('s3')->exists($fileName)) {
            Storage::disk('s3')->delete($fileName);
        }
    }

    public static function DeleteFromStorage($fileName)
    {
        if ($fileName && Storage::disk('s3')->exists($fileName)) {
            Storage::disk('s3')->delete($fileName);
        }
    }
}
