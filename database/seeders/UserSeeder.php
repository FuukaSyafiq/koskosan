<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Hash;
use App\Models\User;
use Illuminate\Support\Facades\Hash as FacadesHash;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $password = FacadesHash::make('password');
        $datas = [
            //admin 
            ["name" => "Umi Qosim", "email" => "admin@gmail.com", "password" => $password,"role_id" => Role::getIdByRole("OWNER"), "address" => "BABADAN RT 02, WONOREJO, KEDAWUNG, SRAGEN", "contact" => "08354354210", "ktp_id" => Image::getIdByFilename("ktp_dummy.jpeg")],
            // penyewa
            ["name" => "Syafiq", "email" => "syafiqparadisam@gmail.com", "password" => $password, "role_id" => Role::getIdByRole("PENYEWA"), "address" => "Jalan Raya Sukowati No. 15, Sragen", "contact" => "08816977857", "ktp_id" => Image::getIdByFilename("ktp_dummy3.jpeg")],
            ["name" => "Rafi", "email" => "rafir0532@gmail.com", "password" => $password, "role_id" => Role::getIdByRole("PENYEWA"), "address" => "Jalan Diponegoro No. 23, Sragen Wetan, Sragen", "contact" => "087753966298", "ktp_id" => Image::getIdByFilename("ktp_dummy2.jpeg")],
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
