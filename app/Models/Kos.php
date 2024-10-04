<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kos extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = "kos";

    protected $fillable = ['name', 'adress'];


    public static function getKosByLocation($location) {
        return self::where('location', 'LIKE', $location)->get();
    }

    public static function getKosIdByName($name) {
        return self::where('name', $name)->first()->id;
    }

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
}
