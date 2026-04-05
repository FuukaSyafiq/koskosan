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
                "tipe" => "Ekonomis",
                "facility" => "Lemari, Single bed, TV",
                "ukuran" => "3x3",
                "price" => 70000
            ],
            [
                "tipe" => "Standard",
                "facility" => "Lemari, Single bed, TV, Dapur, AC",
                "ukuran" => "4x5",
                "price" => 120000
            ],
            [
                "tipe" => "Lengkap",
                "facility" => "Lemari, Single bed, TV, Dapur, AC, Meja Belajar, Kulkas",
                "ukuran" => "5x6",
                "price" => 200000
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
