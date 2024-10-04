<?php

namespace Database\Seeders;

use App\Models\Kos;
use App\Models\Room;
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
            ["name" => "Kos Sragen Double Bed dengan Dapur", "available" => true, "price" => 350000, "description" => "lorem ipsum", "facility" => "Dapur,Double bed,Lemari,Single bed,TV", "kos_id" => Kos::getKosIdByName("Kos Umi Qosim")],
            ["name" => "Kos Sragen Single Bed dengan TV dan WC", "available" => true, "price" => 150000, "description" => "lorem ipsum", "facility" => "Single bed,TV,WC,Dapur,Lemari", "kos_id" => Kos::getKosIdByName("Kos Umi Qosim")],
            ["name" => "Kos Sragen Kipas Angin dan WC", "available" => true, "price" => 100000, "description" => "lorem ipsum", "facility" => "Kipas angin,WC", "kos_id" => Kos::getKosIdByName("Kos Umi Qosim")],
            ["name" => "Kos Sragen Single Bed dengan Kamar Mandi", "available" => true, "price" => 170000, "description" => "lorem ipsum", "facility" => "Lemari,Kamar Mandi,WC,Single bed", "kos_id" => Kos::getKosIdByName("Kos Umi Qosim")],
            ["name" => "Kos Sragen Double Bed dengan WC dan Kipas Angin", "available" => true, "price" => 400000, "description" => "lorem ipsum", "facility" => "Double bed,WC,Kipas angin", "kos_id" => Kos::getKosIdByName("Kos Umi Qosim")],
            ["name" => "Kos Sragen Lemari dan Kipas Angin", "available" => true, "price" => 400000, "description" => "lorem ipsum", "facility" => "Lemari,Kipas angin", "kos_id" => Kos::getKosIdByName("Kos Umi Qosim")],
            ["name" => "Kos Sragen Kamar Mandi dan Kipas Angin", "available" => true, "price" => 300000, "description" => "lorem ipsum", "facility" => "Kamar Mandi,Dapur,Kipas angin", "kos_id" => Kos::getKosIdByName("Kos Umi Qosim")],
            ["name" => "Kos Sragen Kamar Mandi dengan TV", "available" => true, "price" => 350000, "description" => "lorem ipsum", "facility" => "Kamar Mandi,TV", "kos_id" => Kos::getKosIdByName("Kos Umi Qosim")],
            ["name" => "Kos Sragen Lemari dan Dapur", "available" => true, "price" => 400000, "description" => "lorem ipsum", "facility" => "Lemari,Dapur", "kos_id" => Kos::getKosIdByName("Kos Umi Qosim")],
            ["name" => "Kos Sragen TV dengan Kamar Mandi", "available" => true, "price" => 100000, "description" => "lorem ipsum", "facility" => "TV,Kamar Mandi", "kos_id" => Kos::getKosIdByName("Kos Umi Qosim")]
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
