<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TipeRoom extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'tipe_room';

    protected $fillable = [
        "tipe",
        "facility",
        "ukuran",
        "price"
    ];

    public static function getAllTipeRooms()
    {
        return self::select('tipe_room.tipe', 'tipe_room.id', 'tipe_room.facility', 'tipe_room.price', 'tipe_room.ukuran', DB::raw('MIN(images.path) as image_path'))
            ->join('images', 'images.tipe_room_id', '=', 'tipe_room.id')
            ->groupBy('tipe_room.id', 'tipe_room.tipe', 'tipe_room.facility', 'tipe_room.price', 'tipe_room.ukuran')
            ->get();
    }

    public static function getIdByTipeRoom($tipe)
    {
        return self::where('tipe', $tipe)->first()->id;
    }
}
