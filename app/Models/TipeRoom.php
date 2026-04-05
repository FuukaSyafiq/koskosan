<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipeRoom extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'tipe_room';

    protected $fillable = [
        'tipe',
        'facility',
        'ukuran',
        'price',
        'image',
    ];

    public static function getAllTipeRooms()
    {
        return self::select('tipe_room.tipe', 'tipe_room.id', 'tipe_room.facility', 'tipe_room.price', 'tipe_room.ukuran', 'tipe_room.image')
            ->get();
    }

    public static function getTipeRoomById($id)
    {
        return self::where('tipe_room.id', $id)->get();
    }

    public static function getIdByTipeRoom($tipe)
    {
        return self::where('tipe', $tipe)->first()->id;
    }
}
