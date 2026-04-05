<?php

namespace App\Http\Controllers;

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

        if (! isset($room[0])) {
            return redirect()->to('/denah');
        }

        $review = Review::getReviewsByRoomId($id);

        $avgRating = Review::getAverageStarForRoom($id);

        $roomDetail = Room::getRoomDetailById($id);
        $tipeRoom = TipeRoom::find($roomDetail->tipe_room_id);

        return view('room.room-details', ['id' => $id, 'room' => $room, 'review' => $review, 'avgRating' => $avgRating, 'tipeRoom' => $tipeRoom ? $tipeRoom->tipe : 'Not Available', 'price' => $tipeRoom->price, 'facility' => $tipeRoom->facility]);
    }

    public function getvrbyid($id)
    {
        try {
            $room = Room::find($id);
            $vr = $room ? $room->image_vr : null;

            return view('vr', ['vr' => $vr]);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function search(Request $request)
    {
        $location = $request->input('location');
        $datas = [
            [
                'name' => 'Kost tempat tidur 1',
                'available' => false,
                'price' => 1000000,
                'kos_id' => 1,
                'facility' => 'Kamar tidur, tempat mandi',
            ],
        ];

        return view('room.rooms', ['location' => $location, 'datas' => $datas]);
    }
}
