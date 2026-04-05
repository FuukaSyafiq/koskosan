<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
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
            ['name' => 'Sri Goyang Sri', 'email' => 'admin@gmail.com', 'password' => $password, 'role_id' => Role::getIdByRole('OWNER'), 'address' => 'Mantingan, Ngawi, Jawa timur', 'contact' => '08327482743272334', 'ktp_url' => 'KTP/ktp_dummy.jpeg'],
            ['name' => 'penyewa', 'email' => 'penyewa@gmail.com', 'password' => $password, 'role_id' => Role::getIdByRole('PENYEWA'), 'address' => 'Geneng, Ngawi, Jawa timur', 'contact' => '02364873263274632', 'ktp_url' => 'KTP/ktp_dummy.jpeg'],
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
