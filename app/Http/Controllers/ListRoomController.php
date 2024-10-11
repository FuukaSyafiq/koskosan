<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\TipeRoom;
use Log;

class ListRoomController extends Controller
{
    public function gets()
    {

        $rooms = Room::getAvailableRooms();
        // dd($rooms);

        // foreach ($rooms as $room) {
        //     $tipeRoom = TipeRoom::find($room->tipe_room_id);
        //     $room->tipeRoom = $tipeRoom ? $tipeRoom->tipe : 'Not Available'; // Add tipe to each room
        //     dd($tipeRoom);
        // }


        return response()->view('room-list', ['user' => auth()->user(), 'rooms' => $rooms]);
    }
    public function store(Request $request)
    {
        // dd($request);

        return redirect()->to("/roomlist");
    }
}
