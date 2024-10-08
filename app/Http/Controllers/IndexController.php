<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;

class IndexController extends Controller
{
    public function gets()
    {
        
        // $datas = Room::getAvailableRooms();

        return view('index', ['user' => auth()->user()]);
    }
    public function store(Request $request) {
        dd($request);

        return redirect()->to("/");
    }
}
