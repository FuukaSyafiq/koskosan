<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    use HasFactory;

    protected $fillable = ['rented_room_id', 'amount', 'is_settled', 'due_date', 'tanggal_notif', 'no_invoice'];

    public function rentedRoom()
    {
        return $this->belongsTo(RentedRoom::class);
    }
}
