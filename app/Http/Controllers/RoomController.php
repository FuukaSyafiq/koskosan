<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Review;
use App\Models\Room;
use App\Models\TipeRoom;
use Exception;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function details($id)
    {

        $room = Room::getRoomById($id);
        // dd($room)

        // dd(json_encode($data));
        $review = Review::getReviewsByRoomId($id);
        $avgRating = Review::getAverageStarForRoom($id);

        $roomDetail = Room::getRoomDetailById($id);
        $tipeRoom = TipeRoom::find($roomDetail->tipe_room_id);

        return view('room.room-details', ["id" => $id, "room" => $room, "review" => $review, "avgRating" => $avgRating, "tipeRoom" => $tipeRoom ? $tipeRoom->tipe : 'Not Available', 'price' => $tipeRoom->price, 'facility' => $tipeRoom->facility]);
    }

    public function getvrbyid($id)
    {
        try {
            $vr = Image::getVrById($id);

            // dd($vr);
            // return view('vr', ["vr" => $vr]);
            return response()->json($vr, 200);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function search(Request $request)
    {
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
