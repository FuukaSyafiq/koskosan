<?php

namespace Database\Seeders;

use App\Models\Review;
use App\Models\Room;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [
            [
                "review" => "Tempat yang sangat nyaman dan bersih. Sangat direkomendasikan!",
                "star" => 5,
                "user_id" => User::getIdByName("penyewa"),
                "room_id" => Room::getRandomRoomIdByTipeRoom("Lengkap"),
            ],
        ];

        foreach ($datas as $data) {
            Review::create($data);
        }
    }

    public static function down()
    {
        Review::query()->delete();
    }
}
