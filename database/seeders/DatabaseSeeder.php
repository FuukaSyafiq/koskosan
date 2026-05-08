<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Seed Roles
        $penyewaId = DB::table('roles')->insertGetId(['role' => 'PENYEWA']);
        $ownerId = DB::table('roles')->insertGetId(['role' => 'OWNER']);

        // 2. Seed Users
        DB::table('users')->insert([
            [
                'name' => 'Sri Goyang Sri',
                'email' => 'admin@gmail.com',
                'role_id' => $ownerId,
                'password' => '$2y$10$Y/GZAqCiiCixJVWQ5GMOqeVp4L8I/Eiiy1X19Bkt3DGeHc.H/VLza',
                'contact' => '08327482743272334',
                'address' => 'Mantingan, Ngawi, Jawa timur',
                'ktp_url' => 'KTP/ktp_dummy.jpeg',
            ],
            [
                'name' => 'penyewa',
                'email' => 'penyewa@gmail.com',
                'role_id' => $penyewaId,
                'password' => '$2y$10$.YKkXg9EERx3TudbmNoUduTaNbT6iSRH2OxjDuC2fHmfivE00jH92',
                'contact' => '02364873263274632',
                'address' => 'Geneng, Ngawi, Jawa timur',
                'ktp_url' => 'KTP/01KNNQXGR8FPV8AE6KEW3STZJE.jpeg',
            ],
        ]);

        // 3. Seed Tipe Room
        $ekonomisId = DB::table('tipe_room')->insertGetId(['tipe' => 'Ekonomis', 'facility' => 'Lemari, Single bed, TV', 'ukuran' => '3x3', 'price' => 700000, 'image' => 'TipeRoom/01KNNM2TSWZM3SNV2XZK13GTVW.webp']);
        $standardId = DB::table('tipe_room')->insertGetId(['tipe' => 'Standard', 'facility' => 'Lemari, Single bed, TV, Dapur, AC', 'ukuran' => '4x5', 'price' => 1200000, 'image' => 'TipeRoom/01KNNMAECZFGZJGB46Z8A1HA5C.jpeg']);
        $lengkapId = DB::table('tipe_room')->insertGetId(['tipe' => 'Lengkap', 'facility' => 'Lemari, Single bed, TV, Dapur, AC, Meja Belajar, Kulkas', 'ukuran' => '5x6', 'price' => 300000, 'image' => 'TipeRoom/01KNNMAZTJA2YGZBTC0Y3ENAVP.jpg']);

        // 4. Seed Rooms
        DB::table('rooms')->insert([
            ['name' => 'Kamar 10', 'available' => true, 'tipe_room_id' => $ekonomisId, 'description' => 'lorem ipsum', 'address' => 'AyoNgekost Ibu Sri', 'image' => 'Room/01KNNMNKW6C9DFJGQVYWAJ44SX.webp'],
            ['name' => 'Kamar 9', 'available' => true, 'tipe_room_id' => $ekonomisId, 'description' => 'lorem ipsum', 'address' => 'AyoNgekost Ibu Sri', 'image' => 'Room/01KNNMP3V3AMRA4V0Q9KEYMD4Y.jpg'],
            ['name' => 'Kamar 8', 'available' => true, 'tipe_room_id' => $ekonomisId, 'description' => 'lorem ipsum', 'address' => 'AyoNgekost Ibu Sri', 'image' => 'Room/01KNNMPX3AX8E3JD6FV7VFARXC.jpg'],
            ['name' => 'Kamar 7', 'available' => true, 'tipe_room_id' => $standardId, 'description' => 'lorem ipsum', 'address' => 'AyoNgekost Ibu Sri', 'image' => 'Room/01KNNMQDFJT11NJXRYVRER25N9.jpeg'],
            ['name' => 'Kamar 6', 'available' => true, 'tipe_room_id' => $standardId, 'description' => 'lorem ipsum', 'address' => 'AyoNgekost Ibu Sri', 'image' => 'Room/01KNNMR22AGXF82TEEST2F8BVE.jpg'],
            ['name' => 'Kamar 5', 'available' => true, 'tipe_room_id' => $standardId, 'description' => 'lorem ipsum', 'address' => 'AyoNgekost Ibu Sri', 'image' => 'Room/01KNNMRP2SDGHMBTS2C7JVYHK6.jpg'],
            ['name' => 'Kamar 2', 'available' => true, 'tipe_room_id' => $lengkapId, 'description' => 'lorem ipsum', 'address' => 'AyoNgekost Ibu Sri', 'image' => 'Room/01KNNMS70ZT423ET1JVHNKFSMQ.jpg'],
            ['name' => 'Kamar 4', 'available' => true, 'tipe_room_id' => $standardId, 'description' => 'lorem ipsum', 'address' => 'AyoNgekost Ibu Sri', 'image' => 'Room/01KNNMSPDBYAMTVBDQ77DT1HVC.jpg'],
            ['name' => 'Kamar 1', 'available' => true, 'tipe_room_id' => $lengkapId, 'description' => 'lorem ipsum', 'address' => 'AyoNgekost Ibu Sri', 'image' => 'Room/01KNNMMAS8YTJKMBSNEB2AS457.jpg'],
            ['name' => 'Kamar 3', 'available' => true, 'tipe_room_id' => $lengkapId, 'description' => 'lorem ipsum', 'address' => 'AyoNgekost Ibu Sri', 'image' => 'Room/01KNNMT7X61R29AW72WM4REDTW.jpg'],
        ]);
    }

    public static function down(): void
    {
        // Nonaktifkan foreign key checks (untuk Postgres bisa pakai TRUNCATE CASCADE atau urutan yang benar)
        // Agar aman, kita hapus data dari tabel yang bergantung dulu (child) baru tabel utama (parent)
        
        DB::table('pendapatan')->truncate();
        DB::table('tagihans')->truncate();
        DB::table('rented_rooms')->truncate();
        DB::table('verifikasi_pembayaran')->truncate();
        DB::table('rooms')->truncate();
        DB::table('users')->truncate();
        DB::table('tipe_room')->truncate();
        DB::table('roles')->truncate();
    }
}
