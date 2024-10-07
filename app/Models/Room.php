<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Support\Facades\DB as FacadesDB;

class Room extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = "rooms";

    // public static function getIdByNameAndKosName($roomName, $kosName)
    // {
    //     $idKos = Kos::getKosIdByName($kosName);
    //     return self::where('name', $roomName)->where('kos_id', $idKos)->first()->id;
    // }

    protected $fillable = ['name', 'available', 'price', 'description', 'facility', 'address'];

    // public function kos()
    // {
    //     return $this->belongsTo(Kos::class);
    // }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function rentedRooms()
    {
        return $this->hasMany(RentedRoom::class);
    }
    
    public static function getRoomById($id)
    {

        return self::select(
            'rooms.name',
            'rooms.price',
            'rooms.id',
            'rooms.description',
            'images.path',
            'images.file_name',
            'reviews.star',
            'reviews.user_id',
            'reviews.review'
        )
            ->join('images', 'images.room_id', '=', 'rooms.id')
            ->join('reviews', 'reviews.room_id', "=", "rooms.id")
            ->where('rooms.id', $id)
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


    public static function getAvailableRooms()
    {

        return self::select(
            'rooms.name as room_name',
            'rooms.price',
            'rooms.id',
            'images.path',
            'images.file_name',
            'reviews.star'
        )
            ->join('images', 'images.room_id', '=', 'rooms.id')
            ->join('reviews', 'reviews.room_id', "=", "rooms.id")
            ->where('rooms.available', true)
            ->get();
    }

    public function Image()
    {
        return $this->belongsTo('');
    }
}
