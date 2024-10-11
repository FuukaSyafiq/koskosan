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
                "user_id" => User::getIdByName("Rafi"),
                "room_id" => Room::getRandomRoomIdByTipeRoom("Lengkap"),
            ],
            [
                "review" => "Kamar luas dengan fasilitas lengkap, sangat puas!",
                "star" => 4,
                "room_id" => Room::getRandomRoomIdByTipeRoom("Lengkap"),
                "user_id" => User::getIdByName("Rafi"),
            ],
            [
                "review" => "Sangat strategis dan dekat dengan pusat kota.",
                "star" => 5,
                "room_id" => Room::getRandomRoomIdByTipeRoom("Lengkap"),
                "user_id" => User::getIdByName("Rafi"),
            ],
            [
                "review" => "Kamar sangat nyaman dan tenang, cocok untuk istirahat setelah seharian beraktivitas.",
                "star" => 5,
                "room_id" => Room::getRandomRoomIdByTipeRoom("Standard"),
                "user_id" => User::getIdByName("Syafiq"),
            ],
            [
                "review" => "Fasilitas lengkap dan dekat dengan tempat makan, sangat puas tinggal di sini!",
                "star" => 4,
                "room_id" => Room::getRandomRoomIdByTipeRoom("Standard"),
                "user_id" => User::getIdByName("Syafiq"),
            ],
            [
                "review" => "Sangat rekomendasi! TV berfungsi dengan baik dan kamar bersih.",
                "star" => 5,
                "room_id" => Room::getRandomRoomIdByTipeRoom("Standard"),
                "user_id" => User::getIdByName("Syafiq"),
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
