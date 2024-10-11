<?php

namespace App\Http\Controllers;

use App\Models\TipeRoom;

class TipeRoomController extends Controller
{
    public function details($id)
    {

        $tipeRoom = TipeRoom::getTipeRoomById($id);

        return view('room.tipe-room-details', ["id" => $id, "tipeRoom" => $tipeRoom]);
    }
}