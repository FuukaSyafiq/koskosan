<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Review extends Model
{
    use HasFactory;

    protected $table = "reviews";

    protected $fillable = ['review', 'star', 'user_id', 'room_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public static function getAverageStarForRoom($roomId)
    {
        return DB::table('reviews as rvw')
            ->select(DB::raw('AVG(rvw.star) as avg_star'))
            ->join('rooms as ro', 'rvw.room_id', '=', 'ro.id')
            ->where('ro.id', $roomId)
            ->first();
    }
   
    public static function getReviewsByRoomId($roomId)
    {
        return DB::table('reviews as rvw')
            ->select('rvw.review', 'rvw.star', 'u.name', 'rvw.created_at')
            ->distinct()
            ->join('rooms as ro', 'rvw.room_id', '=', 'ro.id')
            ->join('users as u', 'rvw.user_id', '=', 'u.id')
            ->where('ro.id', $roomId)
            ->get();
    }
}
