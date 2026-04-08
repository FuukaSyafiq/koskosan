<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\UploadedFile;

class StoreImages
{
    public static function StoreImages($file, $directory = 'Image')
    {
        if (! $file) {
            return null;
	}

	if ($file instanceof UploadedFile) {
            return Storage::disk('s3')->put($directory, $file);
        }

        // 2. Jika ini adalah string (misal pengecekan data lama di DB)
        if (is_string($file)) {
            try {
                // Bungkus exists() dengan try-catch agar tidak crash jika koneksi/prefix bermasalah
                if (Storage::disk('s3')->exists($file)) {
                    return $file;
                }
            } catch (\Exception $e) {
                // Jika folder belum ada atau koneksi gagal, anggap file tidak ada
                Log::warning("S3 Check Failed for $file: " . $e->getMessage());
                return null;
            }
        }

        return null;
    }
}
