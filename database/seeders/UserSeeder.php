<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $password = Hash::make('password');
        $datas = [
            //admin 
            ["name" => "Umi Qosim", "email" => "admin@gmail.com", "password" => $password, "balance" => 500000, "role_id" => Role::getIdByRole("OWNER"), "address" => "BABADAN RT 02, WONOREJO, KEDAWUNG, SRAGEN", "contact" => "000000000000", "ktp_id" => Image::getIdByFilename("ktp_dummy.jpeg")],
            // penyewa
            ["name" => "Agus", "email" => "agus@gmail.com", "password" => $password, "balance" => 500000, "role_id" => Role::getIdByRole("PENYEWA"), "address" => "Jalan Raya Sukowati No. 15, Sragen", "contact" => "000000000000", "ktp_id" => Image::getIdByFilename("ktp_dummy.jpeg")],
            ["name" => "Budi", "email" => "budi@gmail.com", "password" => $password, "balance" => 500000, "role_id" => Role::getIdByRole("PENYEWA"), "address" => "Jalan Diponegoro No. 23, Sragen Wetan, Sragen", "contact" => "081000000000", "ktp_id" => Image::getIdByFilename("ktp_dummy.jpeg")],
        ];

        foreach ($datas as $value) {
            User::create($value);
        }
    }

    public static function down()
    {
        User::query()->delete();
    }
}
