<?php

namespace App\Filament\Resources\RentedRoomResource\Pages;

use App\Filament\Resources\RentedRoomResource;
use App\Models\Role;
use App\Models\Room;
use App\Models\Tagihan;
use App\Models\Transaction;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CreateRentedRoom extends CreateRecord
{
    protected static string $resource = RentedRoomResource::class;

    protected function handleRecordCreation(array $data): Model
    {

        try {
            DB::beginTransaction();

            $userId = $data['user_id'];
            $record = static::getModel()::create([
                "user_id" => $userId,
                "room_id" => $data['room_id'],
                "rent_time" => $data['rent_time']
            ]);

            // Mengupdate room agar tidak tersedia
            $room = Room::where('id', $record->room_id)->first();
            Room::where('id', $room->id)->update(['available' => false]);

            // update balance penyewa
            User::where('id', $userId)->update(["balance" => DB::raw("balance - $room->price")]);

            $owner = User::where('role_id', Role::getIdByRole("OWNER"))->first()->id;
            // update balance owner
            User::where('id', $owner)->update(["balance" => DB::raw("balance + $room->price")]);


            // membuat tagihan sekarang
            $tagihanSekarang = Tagihan::create([
                "amount" => $room->price,
                "rented_room_id" => $record->id,
                "is_settled" => true,
                "due_date" => Carbon::parse($data['rent_time']),
            ]);

            // membuat tagihan untuk bulan depan
            Tagihan::create([
                "amount" => $room->price,
                "rented_room_id" => $record->id,
                "is_settled" => false,
                "tanggal_notif" => Carbon::parse($data['rent_time'])->addDays(25)->format('Y-m-d'),
                "due_date" => Carbon::parse($data['rent_time'])->addDays(30)->format('Y-m-d')
            ]);

            Transaction::create([
                "tagihan_id" => $tagihanSekarang->id,
                "sender_id" => $userId,
                "receiver_id" => $owner
            ]);


            DB::commit();

            return $record;
        } catch (\Exception $e) {
            // Rollback the transaction on error
            DB::rollBack();

            // Log the error message
            Log::error('Error creating DataPendaftar: ' . $e->getMessage());

            // Rethrow the exception or handle it as needed
            throw $e;
        }
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
