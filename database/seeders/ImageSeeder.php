<?php

namespace Database\Seeders;
use App\Models\Image;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Image::create([
            "path" =>"https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTzJa0Tc6hy_tZpLZO0VGmIKQHcxB0ZK2zOHQ&s",
            "file_name" => "ktp_dummy.jpeg",
            "mime_type" => "image/jpeg",
            "size" => 9591,
            "room_id" => null,
        ]);
        Image::create([
            "path" =>"https://image.archify.com/blog/l/v2wkpyvs.jpg",
            "file_name" => "A1.jpg",
            "mime_type" => "image/jpeg",
            "size" => 9591,
            "room_id" => 1,
        ]);
    }

    public static function down() {
        Image::query()->delete();
    }
}
