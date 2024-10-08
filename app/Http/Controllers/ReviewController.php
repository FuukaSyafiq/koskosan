<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store($roomid, Request $request)
    {
        $userId = request()->query('userid');
        // Validate the incoming request data
        $validatedData = $request->validate([
            'review' => ['nullable', 'string'],   // Optional review, must be a string if provided
            'star' => ['required', 'numeric', 'max:5', 'min:1'],    // 'star' is required and must be a number
        ]);

        // dd($validatedData, $userId, $roomid);
        Review::create([
            "review" => $validatedData['review'],
            "star" => $validatedData['star'],
            "user_id" => $userId,
            "room_id" => $roomid,
        ]);

        return redirect()->back();
    }
}
