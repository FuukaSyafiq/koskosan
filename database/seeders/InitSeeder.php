<?php

namespace Database\Seeders;

use App\Models\AnggotaKeluarga;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class InitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call(TipeRoomSeeder::class);
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
        PermissionOwnerSeeder::down();
        PermissionPenyewaSeeder::down();
        PermissionNameSeeder::down();
        ImageSeeder::down();
        RoleSeeder::down();
        TipeRoomSeeder::down();

        // Storage::disk('public')->deleteDirectory('Image');
        Storage::disk('public')->deleteDirectory('INVOICE');
        Storage::disk('public')->deleteDirectory('KTP');
        Storage::disk('public')->deleteDirectory('livewire-tmp');
    }
}
