<?php

namespace App\Filament\Resources\RentedRoomResource\Pages;

use App\Filament\Resources\RentedRoomResource;
use App\Models\RentedRoom;
use Filament\Actions;
use App\Models\Room;
use App\Models\Tagihan;
use Carbon\Carbon;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class EditRentedRoom extends EditRecord
{
    protected static string $resource = RentedRoomResource::class;

    // protected $currentRoom = null;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
    public $currentRoom = null;  // Nilai default

    public function mount($record): void
    {
        parent::mount($record);
        $this->currentRoom = $record;
    }


    protected function handleRecordDeletion(Model $record): void {

        dd($record);
         $record->delete();
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        // Menampilkan data untuk debugging
        $currentRoomId = $this->currentRoom;

        $rentedRoomNow = RentedRoom::where('id', $currentRoomId)->first();

        // Mendapatkan kamar yang saat ini disewa
        $room = Room::where('id', $rentedRoomNow->room_id)->first();
        // dd($room);

        // Jika user_id disediakan dalam data
        if (isset($data['user_id'])) {
            RentedRoom::where('id', $record->id)->update(["user_id" => $data['user_id']]);
        }

        // Jika room_id disediakan dalam data
        if (isset($data['room_id'])) {
            // Mengupdate kamar yang sedang digunakan menjadi tersedia
            $isSuccess = Room::where('id', $room->id)->update(['available' => true]);
            // dd($isSuccess);

            // Mengupdate kamar baru menjadi tidak tersedia
            Room::where('id', $data['room_id'])->update(['available' => false]);

            // Memperbarui room_id di tabel RentedRoom
            RentedRoom::where('id', $record->id)->update(["room_id" => $data['room_id']]);
        }

        // Jika rent_time disediakan dalam data
        if (isset($data['rent_time'])) {
            RentedRoom::where('id', $record->id)->update(["rent_time" => $data['rent_time']]);
            Tagihan::where('rented_room_id', $record->id)->update([
                "due_date" => Carbon::parse($data['rent_time']),
                "tanggal_notif" => Carbon::parse($data['rent_time'])
            ]);
        }

        $record->update($data);

        return $record;
    }

    // protected function handleRecordUpdate(Model $record, array $data): Model
    // {
    //     print_r(json_encode($record));
    //     print_r(json_encode($data));
    //     dd();

    //     $room = Room::where('id', $record->room_id)->first();

    //     if (isset($data['user_id'])) {
    //         RentedRoom::where('id', $record->id)->update(["user_id" => $data['user_id']]);
    //     }

    //     if (isset($data['room_id'])) {
    //         Room::where('id', $room->id)->update(['available' => true]);
    //         Room::where('id', $data['room_id'])->update(['available' => false]);
    //         RentedRoom::where('id', $record->id)->update(["room_id" => $data['room_id']]);
    //     }

    //     if (isset($data['rent_time'])) {
    //         RentedRoom::where('id', $record->id)->update(["rent_time" => $data['rent_time']]);
    //         Tagihan::where('rented_room_id', $record->id)->update([
    //             "due_date" => Carbon::parse($data['rent_time']),
    //         ]);
    //     }

    //     return $record;
    // }
}
