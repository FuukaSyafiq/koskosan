<?php

namespace App\Filament\Resources\RentedRoomResource\Pages;

use App\Filament\Resources\RentedRoomResource;
use App\Helpers\Invoice;
use App\Models\Role;
use App\Models\Room;
use App\Models\Tagihan;
use App\Models\TipeRoom;
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

    protected function getFormActions(): array
    {
        return [
            $this->getCreateFormAction()->label('Buat'),
            $this->getCancelFormAction()->label('Batal'),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Fetch the room ID based on the authenticated user's ID
        $roomId = Room::where('user_id', auth()->user()->id)->value('id');

        // Set the room_id in the form data
        if ($roomId) {
            $data['room_id'] = $roomId; // Assuming 'room_id' is the name of your field
        }

        return $data; // Return the modified data
    }

    protected function handleRecordCreation(array $data): Model
    {

        DB::beginTransaction();
        try {

            // dd($data);
            if (auth()->user()->role_id === Role::getIdByRole("PENYEWA")) {
                $record = static::getModel()::create([
                    "user_id" => auth()->user()->id,
                    "room_id" => $data['room_id'],
                    "rent_time" => $data['rent_time']
                ]);

                // Mengupdate room agar tidak tersedia
                $room = Room::where('id', $record->room_id)->first();
                $room->available = false;
                // Room::where('id', $room->id)->update(['available' => false]);
                $room->save();

                $no_invoice = Invoice::GenerateInvoiceNumber();

                $tipeRoom = TipeRoom::where('id', $room->tipe_room_id)->first();
                // membuat tagihan sekarang
                Tagihan::create([
                    "no_invoice" => $no_invoice,
                    "amount" => $tipeRoom->price,
                    "rented_room_id" => $record->id,
                    "is_settled" => false,
                    "tanggal_dibayar" => null,
                    "due_date" => Carbon::parse($data['rent_time']),
                    "tanggal_notif" => Carbon::parse($data['rent_time']),
                ]);

                $record->save();

                DB::commit();
                return $record;
            }

            $userId = $data['user_id'];
            $record = static::getModel()::create([
                "user_id" => $userId,
                "room_id" => $data['room_id'],
                "rent_time" => $data['rent_time']
            ]);

            // dd($record);
            // Mengupdate room sebelumnya agar tersedia
            $room = Room::where('id', $record->room_id)->first();
            $room->available = false;
            $room->save();

            $tipeRoom = TipeRoom::where('id', $room->tipe_room_id)->first();
            // dd($room);
            // $room = Room::where('id', $room->id)->first();

            // ->update(['available' => false]);

            $no_invoice = Invoice::GenerateInvoiceNumber();

            // membuat tagihan sekarang
            Tagihan::create([
                "no_invoice" => $no_invoice,
                "amount" => $tipeRoom->price,
                "rented_room_id" => $record->id,
                "is_settled" => false,
                "tanggal_dibayar" => null,
                "due_date" => Carbon::parse($data['rent_time']),
                "tanggal_notif" => Carbon::parse($data['rent_time']),
            ]);

            // dd($record);
            $record->save();
            DB::commit();

            return $record;
        } catch (\Exception $e) {
            // Rollback the transaction on error
            DB::rollBack();

            // Log the error message
            Log::error('Error creating RentedRoom: ' . $e->getMessage());

            // Rethrow the exception or handle it as needed
            throw $e;
        }
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
