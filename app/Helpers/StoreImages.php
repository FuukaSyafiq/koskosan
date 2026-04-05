<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\File;

class StoreImages
{
    public static function StoreImages($file, $directory = 'Image')
    {
        if (! $file) {
            return null;
        }

        if ($file instanceof File) {
            $path = Storage::disk('s3')->put($directory, $file);

            return $directory.'/'.$file->getFilename();
        }

        if (is_string($file) && Storage::disk('s3')->exists($file)) {
            return $file;
        }

        return null;
    }
}
