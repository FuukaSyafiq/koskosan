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
            ["name" => "1A", "available" => true, "price" => 350000, "description" => "lorem ipsum", "facility" => "Dapur,Double bed,Lemari,Single bed,TV", "kos_id" => 1],
            ["name" => "2A", "available" => true, "price" => 150000, "description" => "lorem ipsum", "facility" => "Single bed,TV,WC,Dapur,Lemari", "kos_id" => 1],
            ["name" => "3A", "available" => true, "price" => 100000, "description" => "lorem ipsum", "facility" => "Kipas angin,WC", "kos_id" => 1],
            ["name" => "4A", "available" => true, "price" => 170000, "description" => "lorem ipsum", "facility" => "Lemari,Kamar Mandi,WC,Single bed", "kos_id" => 1],
            ["name" => "5A", "available" => true, "price" => 400000, "description" => "lorem ipsum", "facility" => "Double bed,WC,Kipas angin", "kos_id" => 1],
            ["name" => "1B", "available" => true, "price" => 400000, "description" => "lorem ipsum", "facility" => "Lemari,Kipas angin", "kos_id" => 1],
            ["name" => "2B", "available" => true, "price" => 300000, "description" => "lorem ipsum", "facility" => "Kamar Mandi,Dapur,Kipas angin", "kos_id" => 1],
            ["name" => "3B", "available" => true, "price" => 350000, "description" => "lorem ipsum", "facility" => "Kamar Mandi,TV", "kos_id" => 1],
            ["name" => "4B", "available" => true, "price" => 400000, "description" => "lorem ipsum", "facility" => "Lemari,Dapur", "kos_id" => 1],
            ["name" => "5B", "available" => true, "price" => 100000, "description" => "lorem ipsum", "facility" => "TV,Kamar Mandi", "kos_id" => 1],
        ];


		foreach ($datas as $value) {
			Room::create($value);
		}
    }

    public static function down() {
        Room::query()->delete();
    }
}
