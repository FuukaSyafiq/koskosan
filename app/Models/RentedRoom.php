<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentedRoom extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'room_id', 'rent_time'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    public function tagihans()
    {
        return $this->hasMany(Tagihan::class);
    }
}
