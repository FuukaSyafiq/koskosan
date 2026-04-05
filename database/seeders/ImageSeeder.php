<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\File;

class ImageSeeder extends Seeder
{
    public function run(): void
    {
        $this->uploadKtpDummy();
    }

    private function uploadKtpDummy(): void
    {
        $localPath = public_path('assets/ktp_dummy.jpeg');

        if (! file_exists($localPath)) {
            return;
        }

        Storage::disk('s3')->put(
            'KTP',
            new File($localPath)
        );
    }

    public static function down()
    {
        Storage::disk('s3')->deleteDirectory('KTP');
    }
}
