<?php

namespace Database\Seeders;
use App\Models\Kos;
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
        ]);
    }

    public static function down() {
        Kos::query()->delete();
    }
}
