<?php

namespace Database\Seeders;

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
            ["name" => "Kos Umi Qosim Double Bed dengan Dapur", "available" => true, "price" => 350000, "description" => "lorem ipsum", "facility" => "Dapur,Double bed,Lemari,Single bed,TV", "address" => "KosLoka Ibu Qosim"],
            ["name" => "Kos Umi Qosim Single Bed dengan TV dan WC", "available" => true, "price" => 150000, "description" => "lorem ipsum", "facility" => "Single bed,TV,WC,Dapur,Lemari", "address" => "KosLoka Ibu Qosim"],
            ["name" => "Kos Umi Qosim Kipas Angin dan WC", "available" => true, "price" => 100000, "description" => "lorem ipsum", "facility" => "Kipas angin,WC", "address" => "KosLoka Ibu Qosim"],
            ["name" => "Kos Umi Qosim Single Bed dengan Kamar Mandi", "available" => true, "price" => 170000, "description" => "lorem ipsum", "facility" => "Lemari,Kamar Mandi,WC,Single bed", "address" => "KosLoka Ibu Qosim"],
            ["name" => "Kos Umi Qosim Double Bed dengan WC dan Kipas Angin", "available" => true, "price" => 400000, "description" => "lorem ipsum", "facility" => "Double bed,WC,Kipas angin", "address" => "KosLoka Ibu Qosim"],
            ["name" => "Kos Umi Qosim Lemari dan Kipas Angin", "available" => true, "price" => 400000, "description" => "lorem ipsum", "facility" => "Lemari,Kipas angin", "address" => "KosLoka Ibu Qosim"],
            ["name" => "Kos Umi Qosim Kamar Mandi dan Kipas Angin", "available" => true, "price" => 300000, "description" => "lorem ipsum", "facility" => "Kamar Mandi,Dapur,Kipas angin", "address" => "KosLoka Ibu Qosim"],
            ["name" => "Kos Umi Qosim Kamar Mandi dengan TV", "available" => true, "price" => 350000, "description" => "lorem ipsum", "facility" => "Kamar Mandi,TV", "address" => "KosLoka Ibu Qosim"],
            ["name" => "Kos Umi Qosim Lemari dan Dapur", "available" => true, "price" => 400000, "description" => "lorem ipsum", "facility" => "Lemari,Dapur", "address" => "KosLoka Ibu Qosim"],
            ["name" => "Kos Umi Qosim TV dengan Kamar Mandi", "available" => true, "price" => 100000, "description" => "lorem ipsum", "facility" => "TV,Kamar Mandi", "address" => "KosLoka Ibu Qosim"],
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
