<?php

namespace Database\Seeders;
use App\Models\Kos;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kos::create([
            "name" => "Kos Umi Qosim",
            "address" => "BABADAN RT 02, WONOREJO, KEDAWUNG, SRAGEN",
            "user_id" => User::getIdByName("Umi Qosim")
        ]);
    }

    public static function down() {
        Kos::query()->delete();
    }
}
