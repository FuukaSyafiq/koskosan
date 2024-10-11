<?php

use Illuminate\Support\Facades\Storage;
use App\Models\Image;

function DeleteImages($fileName)
{
	if (Storage::disk("public")->exists($fileName)) {
		Storage::disk("public")->delete($fileName);
	}

	Image::where('file_name', $fileName)->delete();
}

function DeleteFromStorage($fileName)
{
	if (Storage::disk("public")->exists($fileName)) {
		Storage::disk("public")->delete($fileName);
	}
}
