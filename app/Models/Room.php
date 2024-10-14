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

    public static function getAllRoomInDenah()
    {
        return self::distinct()
            ->leftJoin('images', 'images.room_id', '=', 'rooms.id')
            ->where('images.is_vr', false) // Filter to only include non-VR images
            ->groupBy([
                'rooms.id',
                'rooms.name',
            ])
            ->select([
                'rooms.id',
                'rooms.name',
                DB::raw('MIN(images.path) as path') // Get the path of the first non-VR image
            ])->orderBy('id', 'asc')
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
            'tipe_room.id',
            'images.path'
        )
            ->join('images', 'images.room_id', '=', 'rooms.id')
            ->join('tipe_room', 'rooms.tipe_room_id', '=', 'tipe_room.id')
            ->where('rooms.id', $id)->where('images.is_vr', false)
            ->get();
    }
    public static function getAvailableRooms()
    {
        return self::select(
            'rooms.id',
            'rooms.address',
            'rooms.name',
            'tipe_room.facility',
            'tipe_room.price',
            'rooms.available',
            'tipe_room.tipe',
            'tipe_room.ukuran',
            DB::raw('MIN(images.path) as path')
        )
            ->join('images', 'images.room_id', '=', 'rooms.id')
            ->join('tipe_room', 'rooms.tipe_room_id', '=', 'tipe_room.id')
            ->groupBy(
                'rooms.id',
                'rooms.address',
                'rooms.name',
                'tipe_room.facility',
                'tipe_room.price',
                'tipe_room.tipe',
                'tipe_room.ukuran'
            )->where('images.is_vr', false)
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

    public static function getRoomDetailById($id)
    {
        return Room::where('id', $id)->first();  // Use first() to get a single model instance
    }
}
