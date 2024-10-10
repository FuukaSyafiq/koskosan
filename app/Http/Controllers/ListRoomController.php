<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;

class ListRoomController extends Controller
{
    public function gets()
    {

        $rooms = Room::getAvailableRooms();

        return view('room-list', ['user' => auth()->user(), 'rooms' => $rooms]);
    }
    public function store(Request $request)
    {
        dd($request);

        return redirect()->to("/roomlist");
    }
}
