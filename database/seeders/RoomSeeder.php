<?php

namespace Database\Seeders;

use App\Models\Room;
use App\Models\TipeRoom;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [
            [
                "name" => "Kos Umi Qosim Full AC Dengan Dapur",
                "available" => true,
                "description" => "lorem ipsum",
                "address" => "KosLoka Ibu Qosim",
                "tipe_room_id" => TipeRoom::getIdByTipeRoom("FULL AC")
            ],
            [
                "name" => "Kos Umi Qosim FULL AC dengan TV dan WC",
                "available" => true,
                "description" => "lorem ipsum",
                "address" => "KosLoka Ibu Qosim",
                "tipe_room_id" => TipeRoom::getIdByTipeRoom("FULL AC")
            ],
            [
                "name" => "Kos Umi Qosim Kipas Angin dan WC FULL AC",
                "available" => true,
                "description" => "lorem ipsum",
                "address" => "KosLoka Ibu Qosim",
                "tipe_room_id" => TipeRoom::getIdByTipeRoom("FULL AC")
            ],
            [
                "name" => "Kos Umi Qosim Single Bed dengan Kamar Mandi",
                "available" => true,
                "description" => "lorem ipsum",
                "address" => "KosLoka Ibu Qosim",
                "tipe_room_id" => TipeRoom::getIdByTipeRoom("1 AC")
            ],
            [
                "name" => "Kos Umi Qosim Double Bed dengan WC dan Kipas Angin",
                "available" => true,
                "tipe_room_id" => TipeRoom::getIdByTipeRoom("1 AC"),
                "description" => "lorem ipsum",
                "address" => "KosLoka Ibu Qosim"
            ],
            [
                "name" => "Kos Umi Qosim Lemari dan Kipas Angin",
                "available" => true,
                "tipe_room_id" => TipeRoom::getIdByTipeRoom("1 AC"),
                "description" => "lorem ipsum",
                "address" => "KosLoka Ibu Qosim"
            ],
            [
                "name" => "Kos Umi Qosim Kamar Mandi dan Kipas Angin",
                "available" => true,
                "description" => "lorem ipsum",
                "address" => "KosLoka Ibu Qosim",
                "tipe_room_id" => TipeRoom::getIdByTipeRoom("1 AC"),
            ],
            [
                "name" => "Kos Umi Qosim Kamar Mandi dengan TV",
                "available" => true,
                "description" => "lorem ipsum",
                "address" => "KosLoka Ibu Qosim",
                "tipe_room_id" => TipeRoom::getIdByTipeRoom("NO AC"),
            ],
            [
                "name" => "Kos Umi Qosim Lemari dan Dapur",
                "available" => true,
                "description" => "lorem ipsum",
                "address" => "KosLoka Ibu Qosim",
                "tipe_room_id" => TipeRoom::getIdByTipeRoom("NO AC"),
            ],
            [
                "name" => "Kos Umi Qosim TV dengan Kamar Mandi",
                "available" => true,
                "description" => "lorem ipsum",
                "address" => "KosLoka Ibu Qosim",
                "tipe_room_id" => TipeRoom::getIdByTipeRoom("NO AC"),
            ],
        ];


        foreach ($datas as $value) {
            Room::create($value);
        }
    }

    public static function down()
    {
        Room::query()->delete();
    }
}
