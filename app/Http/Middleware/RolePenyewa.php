<?php

namespace App\Http\Middleware;

use App\Models\RentedRoom;
use App\Models\Role;
use App\Models\Room;
use App\Models\Tagihan;
use Carbon\Carbon;
use Closure;
use Filament\Notifications\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RolePenyewa
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && auth()->user()->role_id === Role::getIdByRole('PENYEWA')) {
            // dd("is success")a 
            // $penyewa = auth()->user();
            // $rentedRooms = RentedRoom::where('user_id', $penyewa->id)->get();
            // if (isset($rentedRooms)) {
            //     foreach ($rentedRooms as $rentedRoom) {
            //         // dd($rentedRoom);
            //         $room = Room::where('id', $rentedRoom->room_id)->first();
            //         $tagihanYangBelumDibayars = Tagihan::where('rented_room_id', $rentedRoom->id)->where('is_settled', false)->get();

            //         foreach ($tagihanYangBelumDibayars as $tagihanYangBelumDibayar) {
            //             if (isset($tagihanYangBelumDibayar)) {
            //                 Notification::make()->title("Ada tagihan yang belum dibayar")->body("Harap segera melunasi tagihan $room->name sebelum tenggat waktu " . Carbon::parse($tagihanYangBelumDibayar->due_date)->translatedFormat('d F Y'))->warning()->send();
            //             }
            //         }
            //     }
            // }

            return $next($request);
        }
        return redirect()->to('/login');
    }
}
