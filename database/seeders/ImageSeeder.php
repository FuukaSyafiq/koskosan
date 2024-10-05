<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Room;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //KTP dummy
        Image::create([
            "path" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTzJa0Tc6hy_tZpLZO0VGmIKQHcxB0ZK2zOHQ&s",
            "file_name" => "ktp_dummy.jpeg",
            "mime_type" => "image/jpeg",
            "size" => 2000,
        ]);

        // Room images
        $images = [
            [
                "path" => "https://image.archify.com/blog/l/v2wkpyvs.jpg",
                "file_name" => "A2.jpg",
                "mime_type" => "image/jpeg",
                "size" => 2000,
                "room_id" => 1,
            ],
            [
                "path" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT6pMi-cB8rxERxTk1AE94S8tTXaFmzK2Q9pQ&s",
                "file_name" => "A2.jpg",
                "mime_type" => "image/jpeg",
                "size" => 10500,
                "room_id" => 2,
            ],
            [
                "path" => "https://blog.sewakost.com/wp-content/uploads/2015/02/Mensetting-Kamar-Kost-Agar-Menjadi-Lebih-Nyaman.jpg",
                "file_name" => "A3.jpg",
                "mime_type" => "image/jpeg",
                "size" => 2000,
                "room_id" => 3,
            ],
            [
                "path" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTQNHhZ7jVCK0D1Gh5wigBNroZrMhksT62_Ow&s",
                "file_name" => "A4.jpg",
                "mime_type" => "image/jpeg",
                "size" => 2000,
                "room_id" => 4,
            ],
            [
                "path" => "https://sgp1.digitaloceanspaces.com/www.sewakost.com-66ae3a396f56c/listings/04-2022/ad78773/kamar-kost-baru-gress-utk-muslim-putra-1142759643.jpg",
                "file_name" => "A5.jpg",
                "mime_type" => "image/jpeg",
                "size" => 2000,
                "room_id" => 5,
            ],
            [
                "path" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRUSWiNhBdPkj3Tu3qg1sZ9WSrRJduEn9m2bQ&s",
                "file_name" => "B1.jpg",
                "mime_type" => "image/jpeg",
                "size" => 2000,
                "room_id" => 6,
            ],
            [
                "path" => "https://cdn0-production-images-kly.akamaized.net/QHt5mKjVjNx2BgCTeHnqnjOrVJg=/500x500/smart/filters:quality(75):strip_icc():format(webp)/kly-media-production/medias/3143183/original/082060800_1591188998-Kos_5.jpg",
                "file_name" => "B2.jpg",
                "mime_type" => "image/jpeg",
                "size" => 9400,
                "room_id" => 7,
            ],
            [
                "path" => "https://i0.wp.com/bookingkost.com/wp-content/uploads/2021/01/Kost-Putri-Gg-belibis-No-3-1.png?fit=572%2C766&ssl=1",
                "file_name" => "B3.jpg",
                "mime_type" => "image/jpeg",
                "size" => 11500,
                "room_id" => 8,
            ],
            [
                "path" => "https://www.infokostan.com/wp-content/uploads/2014/06/desain-kost-kamar-putri.jpg",
                "file_name" => "B4.jpg",
                "mime_type" => "image/jpeg",
                "size" => 9800,
                "room_id" => 9,
            ],
            [
                "path" => "https://sgp1.digitaloceanspaces.com/www.sewakost.com-66ae3a396f56c/listings/03-2022/ad76102/kost-putri-46-yogyakarta-662668431_x2.jpg",
                "file_name" => "B5.jpg",
                "mime_type" => "image/jpeg",
                "size" => 9900,
                "room_id" => 10,
            ],
        ];

        foreach ($images as $image) {
            Image::create($image);
        }
    }

    public static function down()
    {
        Image::query()->delete();
    }
}
