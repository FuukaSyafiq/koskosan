<?php

namespace Database\Seeders;

use App\Models\AnggotaKeluarga;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $this->call(KosSeeder::class);
        $this->call(RoomSeeder::class);
        $this->call(ImageSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(PermissionNameSeeder::class);
        $this->call(PermissionOwnerSeeder::class);
        $this->call(PermissionPenyewaSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ReviewSeeder::class);
    }


    public static function down()
    {
        ReviewSeeder::down();
        UserSeeder::down();
        PermissionOwnerSeeder::down();
        PermissionPenyewaSeeder::down();
        PermissionNameSeeder::down();
        RoleSeeder::down();
        ImageSeeder::down();
        RoomSeeder::down();
        KosSeeder::down();
    }

}
