<?php

namespace Database\Seeders;

use App\Models\TipeRoom;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipeRoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [
            [
                "tipe" => "FULL AC",
                "facility" => "Dapur,Double bed,Lemari, Single bed, TV, AC 3",
                "ukuran" => "4x4",
                "price" => 1000000
            ],
            [
                "tipe" => "1 AC",
                "facility" => "Dapur,Double bed,Lemari,Single bed,TV, 1 AC",
                "ukuran" => "4x4",
                "price" => 1000000
            ],
            [
                "tipe" => "NO AC",
                "facility" => "Dapur, Lemari, Single bed, TV",
                "ukuran" => "4x4",
                "price" => 1000000
            ]
        ];

        foreach ($datas as $data) {
            TipeRoom::create($data);
        }
    }

    public static function down() {
        TipeRoom::query()->delete();
    }
}
