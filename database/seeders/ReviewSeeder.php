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
                "user_id" => User::getIdByName("Budi"),
                "room_id" => 1,
            ],
            [
                "review" => "Kamar luas dengan fasilitas lengkap, sangat puas!",
                "star" => 4,
                "user_id" => User::getIdByName("Budi"),
                "room_id" => 1,
            ],
            [
                "review" => "Sangat strategis dan dekat dengan pusat kota.",
                "star" => 5,
                "user_id" => User::getIdByName("Budi"),
                "room_id" => 1,
            ],
            [
                "review" => "Kamar sangat nyaman dan tenang, cocok untuk istirahat setelah seharian beraktivitas.",
                "star" => 5,
                "user_id" => User::getIdByName("Agus"),
                "room_id" => 2,
            ],
            [
                "review" => "Fasilitas lengkap dan dekat dengan tempat makan, sangat puas tinggal di sini!",
                "star" => 4,
                "user_id" => User::getIdByName("Agus"),
                "room_id" => 2,
            ],
            [
                "review" => "Sangat rekomendasi! TV berfungsi dengan baik dan kamar bersih.",
                "star" => 5,
                "user_id" => User::getIdByName("Agus"),
                "room_id" => 2,
            ],
        ];

        foreach ($datas as $data) {
            Review::create($data);
        }
    }

    public static function down() {
        Review::query()->delete();
    }
}
