<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $table = 'rooms';

    protected $fillable = ['name', 'available', 'description', 'address', 'tipe_room_id', 'image', 'image_vr'];

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

    public static function getAllRoomInAddress($address)
    {
        return self::select('id', 'name', 'address', 'image')
            ->where('address', 'LIKE', $address)
            ->orderBy('id', 'asc')
            ->get();
    }

    public static function getRandomRoomIdByTipeRoom($tipe)
    {
        $tipeRoomId = TipeRoom::getIdByTipeRoom($tipe);

        return self::where('tipe_room_id', $tipeRoomId)->inRandomOrder()->first()->id;
    }

    public static function getIdByRoom($room)
    {
        return self::where('name', $room)->first()->id;
    }

    public static function getRoomById($id)
    {
        return self::select(
            'rooms.id',
            'rooms.address',
            'rooms.name',
            'rooms.description',
            'rooms.image',
            'rooms.image_vr',
            'tipe_room.id as tipe_room_id',
            'tipe_room.tipe',
            'tipe_room.facility',
            'tipe_room.price',
            'tipe_room.ukuran'
        )
            ->join('tipe_room', 'rooms.tipe_room_id', '=', 'tipe_room.id')
            ->where('rooms.id', $id)
            ->get();
    }

    public static function getAvailableRooms()
    {
        return self::select(
            'rooms.id',
            'rooms.address',
            'rooms.name',
            'rooms.image',
            'tipe_room.facility',
            'tipe_room.price',
            'rooms.available',
            'tipe_room.tipe',
            'tipe_room.ukuran'
        )
            ->join('tipe_room', 'rooms.tipe_room_id', '=', 'tipe_room.id')
            ->get();
    }

    public static function getRoomDetailById($id)
    {
        return Room::where('id', $id)->first();
    }
}
