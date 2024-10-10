<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\TipeRoom;
use Illuminate\Support\Facades\Mail;

class IndexController extends Controller
{
    public function gets()
    {
    //  Mail::to("syafiqpinginfullstack@gmail.com")->send();   
        // $rooms = Room::getAvailableRooms();
        $rooms = TipeRoom::getAllTipeRooms();

        // dd($rooms);
        return view('index', ['user' => auth()->user(), 'rooms' => $rooms]);
    }
    public function store(Request $request) {
        dd($request);

        return redirect()->to("/");
    }
}
