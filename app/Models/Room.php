<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = ['name','available', 'price', 'description', 'facility', 'kos_id'];

    public function kos()
    {
        return $this->belongsTo(Kos::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function rentedRooms()
    {
        return $this->hasMany(RentedRoom::class);
    }
}
