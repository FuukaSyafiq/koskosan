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
        $this->call(RoleSeeder::class);
        $this->call(PermissionNameSeeder::class);
        $this->call(PermissionAdminSeeder::class);
        $this->call(PermissionOperatorSeeder::class);
    }


    public static function down()
    {
        PermissionAdminSeeder::down();
        PermissionOperatorSeeder::down();
        PermissionNameSeeder::down();
        RoleSeeder::down();
    }

}
