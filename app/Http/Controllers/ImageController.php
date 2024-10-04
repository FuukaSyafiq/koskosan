<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Traits\Upload; //import the trait
use Exception;
use Illuminate\Http\Request;
use Str;

class ImageController extends Controller
{
    use Upload; //add this trait

    public function store(Request $request, string $html_key)
    {
        if ($request->hasFile($html_key)) {
            $file = $request->file($html_key);
            $fileName = $file->getFilename() . Str::uuid()->toString() . $file->getClientOriginalExtension();

            $path = $this->UploadFile($file, "", $fileName); //use the method in the trait

            $fileDB = Image::create([
                'file_name' => $fileName,
                'mime_type' => $file->getClientMimeType(),
                'path' => '/storage//' . $path,
                'disk' => 'public',
                'size' => $file->getSize(),
            ]);
            return $fileDB;
        };

        throw new Exception("Error while uploading files", 1);
    }
}
