<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Room extends Model
{
    use HasFactory;

    protected $table = "rooms";

    protected $fillable = ['name', 'available', 'description', 'address', 'tipe_room_id'];

    public function tipe_room()
    {
        return $this->belongsTo(TipeRoom::class, 'tipe_room_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function rentedRooms()
    {
        return $this->hasMany(RentedRoom::class);
    }

    public static function getRandomRoomIdByTipeRoom($tipe)
    {
        $tipeRoomId = TipeRoom::getIdByTipeRoom($tipe);
        return self::where('tipe_room_id', $tipeRoomId)->inRandomOrder()->first()->id;
    }

    public static function getRoomById($id)
    {
        return self::select(
            'rooms.id',
            'rooms.address',
            'rooms.name',
            'rooms.description',
            'rooms.facility',
            'rooms.price',
            'images.path'
        )
            ->distinct() // Menambahkan DISTINCT untuk hasil unik
            ->join('images', 'images.room_id', '=', 'rooms.id')
            ->where('rooms.id', $id)
            ->get();
    }
    public static function getAvailableRooms()
    {
        return self::select(
            'rooms.id',
            'rooms.address',
            'rooms.name',
            'rooms.description',
            'rooms.facility',
            'rooms.price',
            'rooms.available',
            DB::raw('MIN(images.path) as path')
        )
            ->join('images', 'images.room_id', '=', 'rooms.id')
            ->groupBy(
                'rooms.id',
                'rooms.address',
                'rooms.name',
                'rooms.description',
                'rooms.facility',
                'rooms.price'
            )
            ->get();
    }


    public static function getIdByRoomName($roomName)
    {
        return self::select(
            'rooms.id',
            'rooms.name as room_name',
            'rooms.price',
            'rooms.description',
            'rooms.facility',
            'rooms.address',
            'images.path',
            'images.file_name'
        )
            ->join('images', 'images.room_id', '=', 'rooms.id')
            ->where('rooms.available', true)
            ->where('rooms.name', $roomName)
            ->get();
    }

    public function Image()
    {
        return $this->belongsTo('');
    }
}
