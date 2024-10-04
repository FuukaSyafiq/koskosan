<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function details($id) {

        $datas = Room::getAvailableRooms();

        return view('room.room-details', ["id" => $id]);
    }

    public function search(Request $request) {
        $location = $request->input('location');
        $datas = [
            [
                "name" => "Kost tempat tidur 1",
                "available" => false,
                "price" => 1000000,
                "kos_id" => 1,
                "facility" => "Kamar tidur, tempat mandi"
            ]
        ];

        return view('room.rooms', ["location" => $location, "datas" => $datas]);
    }
}
