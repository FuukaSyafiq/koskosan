<?php

namespace App\Traits;

use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait Upload
{
	public function UploadFile(UploadedFile $file, $folder, $filename)
	{
		// Menggunakan nama acak jika $filename tidak diberikan
		return $file->storeAs(
			$folder,
			$filename,
			"public"
		);
	}

	public function deleteFile($path, $disk = 'local')
	{
		Storage::disk($disk)->delete($path);
	}
}