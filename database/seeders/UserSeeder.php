<?php

namespace Database\Seeders;

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
                ["name" => "Umi Qosim", "email" => "admin@gmail.com", "password" => $password, "balance" => 500000, "role" => "admin", "address" => "BABADAN RT 02, WONOREJO, KEDAWUNG, SRAGEN", "contact" => "000000000000", "ktp_id" => "1" ], 
                // penyewa
                ["name" => "Agus", "email" => "agus@gmail.com", "password" => $password, "balance" => 500000, "role" => "tenant", "address" => "Jalan Raya Sukowati No. 15, Sragen", "contact" => "000000000000", "ktp_id" => "2" ],
                ["name" => "Budi", "email" => "budi@gmail.com", "password" => $password, "balance" => 500000, "role" => "tenant", "address" => "Jalan Diponegoro No. 23, Sragen Wetan, Sragen", "contact" => "000000000000", "ktp_id" => "3" ],
                ["name" => "Citra", "email" => "citra@gmail.com", "password" => $password, "balance" => 500000, "role" => "tenant", "address" => "Jalan Gatot Subroto No. 45, Sragen Tengah, Sragen", "contact" => "000000000000", "ktp_id" => "4" ],
                ["name" => "Dewi", "email" => "dewi@gmail.com", "password" => $password, "balance" => 500000, "role" => "tenant", "address" => "Jalan Veteran No. 8, Sine, Sragen", "contact" => "000000000000", "ktp_id" => "5" ],
                ["name" => "Eka", "email" => "eka@gmail.com", "password" => $password, "balance" => 500000, "role" => "tenant", "address" => "Jalan Dr. Sutomo No. 31, Sragen Kulon, Sragen", "contact" => "000000000000", "ktp_id" => "6" ],
                ["name" => "Fajar", "email" => "fajar@gmail.com", "password" => $password, "balance" => 500000, "role" => "tenant", "address" => "Jalan Raya Solo-Sragen KM 11, Nglorog, Sragen", "contact" => "000000000000", "ktp_id" => "7" ],
                ["name" => "Gita", "email" => "gita@gmail.com", "password" => $password, "balance" => 500000, "role" => "tenant", "address" => "Jalan Cendana No. 9, Pilangsari, Sragen", "contact" => "000000000000", "ktp_id" => "8" ],
                ["name" => "Hari", "email" => "hari@gmail.com", "password" => $password, "balance" => 500000, "role" => "tenant", "address" => "Jalan Taman Asri No. 22, Sidoharjo, Sragen", "contact" => "000000000000", "ktp_id" => "9" ],
                ["name" => "Indah", "email" => "indah@gmail.com", "password" => $password, "balance" => 500000, "role" => "tenant", "address" => "Jalan Raya Sragen-Ngawi No. 34, Jenar, Sragen", "contact" => "000000000000", "ktp_id" => "10" ],
                ["name" => "Joko", "email" => "joko@gmail.com", "password" => $password, "balance" => 500000, "role" => "tenant", "address" => "Jalan Ronggowarsito No. 5, Karangmalang, Sragen", "contact" => "000000000000", "ktp_id" => "11" ],
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
