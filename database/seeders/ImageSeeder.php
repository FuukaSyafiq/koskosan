<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Room;
use App\Models\TipeRoom;
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

        Image::create([
            "path" => "https://assets.promediateknologi.id/crop/0x0:0x0/750x500/webp/photo/infoindonesia/news/2021/01/20210105012729_original.jpg",
            "file_name" => "ktp_dummy2.jpeg",
            "mime_type" => "image/jpeg",
            "size" => 2000,
        ]);

        Image::create([
            "path" => "https://umsu.ac.id/artikel/wp-content/uploads/2023/11/cara-mudah-cek-ktp-asli-atau-palsu-718x375.jpeg",
            "file_name" => "ktp_dummy3.jpeg",
            "mime_type" => "image/jpeg",
            "size" => 2000,
        ]);

        // Room images
        $images = [
            [
                "path" => "https://image.archify.com/blog/l/v2wkpyvs.jpg",
                "file_name" => "A1.jpg",
                "mime_type" => "image/jpeg",
                "size" => 2000,
                "room_id" => Room::getIdByRoom("Kamar 1"),
                "tipe_room_id" => TipeRoom::getIdByTipeRoom("Lengkap")
            ],
            [
                "path" => "/storage/Image/Kamar1.JPG",
                "file_name" => "Kamar1.jpg",
                "mime_type" => "image/jpeg",
                "is_vr" => true,
                "size" => 2000,
                "room_id" => Room::getIdByRoom("Kamar 1"),
                "tipe_room_id" => TipeRoom::getIdByTipeRoom("Lengkap")
            ],
            [
                "path" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT6pMi-cB8rxERxTk1AE94S8tTXaFmzK2Q9pQ&s",
                "file_name" => "A2.jpg",
                "mime_type" => "image/jpeg",
                "size" => 10500,
                "room_id" => Room::getIdByRoom("Kamar 2"),
                "tipe_room_id" => TipeRoom::getIdByTipeRoom("Lengkap")
            ],
            [
                "path" => "/storage/Image/Kamar2.JPG",
                "file_name" => "Kamar2.jpg",
                "mime_type" => "image/jpeg",
                "size" => 2000,
                "is_vr" => true,
                "room_id" => Room::getIdByRoom("Kamar 2"),
                "tipe_room_id" => TipeRoom::getIdByTipeRoom("Lengkap")
            ],
            [
                "path" => "https://blog.sewakost.com/wp-content/uploads/2015/02/Mensetting-Kamar-Kost-Agar-Menjadi-Lebih-Nyaman.jpg",
                "file_name" => "A3.jpg",
                "mime_type" => "image/jpeg",
                "size" => 2000,
                "room_id" => Room::getIdByRoom("Kamar 3"),
                "tipe_room_id" => TipeRoom::getIdByTipeRoom("Lengkap")
            ],
            [
                "path" => "/storage/Image/Kamar3.JPG",
                "file_name" => "Kamar3.jpg",
                "mime_type" => "image/jpeg",
                "size" => 2000,
                "is_vr" => true,
                "room_id" => Room::getIdByRoom("Kamar 3"),
                "tipe_room_id" => TipeRoom::getIdByTipeRoom("Lengkap")
            ],
            [
                "path" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTQNHhZ7jVCK0D1Gh5wigBNroZrMhksT62_Ow&s",
                "file_name" => "A4.jpg",
                "mime_type" => "image/jpeg",
                "tipe_room_id" => TipeRoom::getIdByTipeRoom("Standard"),
                "size" => 2000,
                "room_id" => Room::getIdByRoom("Kamar 4"),
            ],
            [
                "path" => "/storage/Image/Kamar4.JPG",
                "file_name" => "Kamar4.jpg",
                "mime_type" => "image/jpeg",
                "size" => 2000,
                "is_vr" => true,
                "room_id" => Room::getIdByRoom("Kamar 4"),
                "tipe_room_id" => TipeRoom::getIdByTipeRoom("Standard")
            ],
            [
                "path" => "https://sgp1.digitaloceanspaces.com/www.sewakost.com-66ae3a396f56c/listings/04-2022/ad78773/kamar-kost-baru-gress-utk-muslim-putra-1142759643.jpg",
                "file_name" => "A5.jpg",
                "mime_type" => "image/jpeg",
                "room_id" => Room::getIdByRoom("Kamar 5"),
                "tipe_room_id" => TipeRoom::getIdByTipeRoom("Standard"),
                "size" => 2000,
            ],
            [
                "path" => "/storage/Image/Kamar5.JPG",
                "file_name" => "Kamar5.jpg",
                "mime_type" => "image/jpeg",
                "size" => 2000,
                "is_vr" => true,
                "room_id" => Room::getIdByRoom("Kamar 5"),
                "tipe_room_id" => TipeRoom::getIdByTipeRoom("Standard")
            ],
            [
                "path" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRUSWiNhBdPkj3Tu3qg1sZ9WSrRJduEn9m2bQ&s",
                "file_name" => "B1.jpg",
                "mime_type" => "image/jpeg",
                "room_id" => Room::getIdByRoom("Kamar 6"),
                "tipe_room_id" => TipeRoom::getIdByTipeRoom("Standard"),
                "size" => 2000,
            ],
            [
                "path" => "/storage/Image/Kamar6.JPG",
                "file_name" => "Kamar6.jpg",
                "mime_type" => "image/jpeg",
                "size" => 2000,
                "is_vr" => true,
                "room_id" => Room::getIdByRoom("Kamar 6"),
                "tipe_room_id" => TipeRoom::getIdByTipeRoom("Standard")
            ],
            [
                "path" => "https://cdn0-production-images-kly.akamaized.net/QHt5mKjVjNx2BgCTeHnqnjOrVJg=/500x500/smart/filters:quality(75):strip_icc():format(webp)/kly-media-production/medias/3143183/original/082060800_1591188998-Kos_5.jpg",
                "file_name" => "B2.jpg",
                "mime_type" => "image/jpeg",
                "room_id" => Room::getIdByRoom("Kamar 7"),
                "tipe_room_id" => TipeRoom::getIdByTipeRoom("Ekonomis"),
                "size" => 9400,
            ],
            [
                "path" => "/storage/Image/Kamar7.JPG",
                "file_name" => "Kamar7.jpg",
                "mime_type" => "image/jpeg",
                "size" => 2000,
                "is_vr" => true,
                "room_id" => Room::getIdByRoom("Kamar 7"),
                "tipe_room_id" => TipeRoom::getIdByTipeRoom("Ekonomis")
            ],
            [
                "path" => "https://i0.wp.com/bookingkost.com/wp-content/uploads/2021/01/Kost-Putri-Gg-belibis-No-3-1.png?fit=572%2C766&ssl=1",
                "file_name" => "B3.jpg",
                "mime_type" => "image/jpeg",
                "room_id" => Room::getIdByRoom("Kamar 8"),
                "tipe_room_id" => TipeRoom::getIdByTipeRoom("Ekonomis"),
                "size" => 11500
            ],
            [
                "path" => "/storage/Image/Kamar8.JPG",
                "file_name" => "Kamar8.jpg",
                "mime_type" => "image/jpeg",
                "size" => 2000,
                "is_vr" => true,
                "room_id" => Room::getIdByRoom("Kamar 8"),
                "tipe_room_id" => TipeRoom::getIdByTipeRoom("Ekonomis")
            ],
            [
                "path" => "https://www.infokostan.com/wp-content/uploads/2014/06/desain-kost-kamar-putri.jpg",
                "file_name" => "B4.jpg",
                "mime_type" => "image/jpeg",
                "room_id" => Room::getIdByRoom("Kamar 9"),
                "tipe_room_id" => TipeRoom::getIdByTipeRoom("Ekonomis"),
                "size" => 9800
            ],
            [
                "path" => "/storage/Image/Kamar9.JPG",
                "file_name" => "Kamar9.jpg",
                "mime_type" => "image/jpeg",
                "size" => 2000,
                "is_vr" => true,
                "room_id" => Room::getIdByRoom("Kamar 9"),
                "tipe_room_id" => TipeRoom::getIdByTipeRoom("Ekonomis")
            ],
            [
                "path" => "https://sgp1.digitaloceanspaces.com/www.sewakost.com-66ae3a396f56c/listings/03-2022/ad76102/kost-putri-46-yogyakarta-662668431_x2.jpg",
                "file_name" => "B5.jpg",
                "mime_type" => "image/jpeg",
                "room_id" => Room::getIdByRoom("Kamar 10"),
                "tipe_room_id" => TipeRoom::getIdByTipeRoom("Ekonomis"),
                "size" => 9900
            ],
            [
                "path" => "/storage/Image/Kamar10.JPG",
                "file_name" => "Kamar10.jpg",
                "mime_type" => "image/jpeg",
                "size" => 2000,
                "is_vr" => true,
                "room_id" => Room::getIdByRoom("Kamar 10"),
                "tipe_room_id" => TipeRoom::getIdByTipeRoom("Ekonomis")
            ],
        ];



        foreach ($images as $image) {
            print_r($image);
            Image::create($image);
        }
    }

    public static function down()
    {
        Image::query()->delete();
    }
}
