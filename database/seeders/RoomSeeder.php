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
                "name" => "Kamar 1",
                "available" => true,
                "description" => "lorem ipsum",
                "address" => "KosLoka Ibu Qosim",
                "tipe_room_id" => TipeRoom::getIdByTipeRoom("Lengkap")
            ],
            [
                "name" => "Kamar 2",
                "available" => true,
                "description" => "lorem ipsum",
                "address" => "KosLoka Ibu Qosim",
                "tipe_room_id" => TipeRoom::getIdByTipeRoom("Lengkap")
            ],
            [
                "name" => "Kamar 3",
                "available" => true,
                "description" => "lorem ipsum",
                "address" => "KosLoka Ibu Qosim",
                "tipe_room_id" => TipeRoom::getIdByTipeRoom("Lengkap")
            ],
            [
                "name" => "Kamar 4",
                "available" => true,
                "description" => "lorem ipsum",
                "address" => "KosLoka Ibu Qosim",
                "tipe_room_id" => TipeRoom::getIdByTipeRoom("Standard")
            ],
            [
                "name" => "Kamar 5",
                "available" => true,
                "tipe_room_id" => TipeRoom::getIdByTipeRoom("Standard"),
                "description" => "lorem ipsum",
                "address" => "KosLoka Ibu Qosim"
            ],
            [
                "name" => "Kamar 6",
                "available" => true,
                "tipe_room_id" => TipeRoom::getIdByTipeRoom("Standard"),
                "description" => "lorem ipsum",
                "address" => "KosLoka Ibu Qosim"
            ],
            [
                "name" => "Kamar 7",
                "available" => true,
                "description" => "lorem ipsum",
                "address" => "KosLoka Ibu Qosim",
                "tipe_room_id" => TipeRoom::getIdByTipeRoom("Standard"),
            ],
            [
                "name" => "kamar 8",
                "available" => true,
                "description" => "lorem ipsum",
                "address" => "KosLoka Ibu Qosim",
                "tipe_room_id" => TipeRoom::getIdByTipeRoom("Ekonomis"),
            ],
            [
                "name" => "Kamar 9",
                "available" => true,
                "description" => "lorem ipsum",
                "address" => "KosLoka Ibu Qosim",
                "tipe_room_id" => TipeRoom::getIdByTipeRoom("Ekonomis"),
            ],
            [
                "name" => "kammar 10",
                "available" => true,
                "description" => "lorem ipsum",
                "address" => "KosLoka Ibu Qosim",
                "tipe_room_id" => TipeRoom::getIdByTipeRoom("Ekonomis"),
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
