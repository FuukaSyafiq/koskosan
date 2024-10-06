<?php

namespace App\Filament\Resources\RentedRoomResource\Pages;

use App\Filament\Resources\RentedRoomResource;
use Filament\Actions;
use App\Models\Room;
use App\Models\Tagihan;
use Carbon\Carbon;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditRentedRoom extends EditRecord
{
    protected static string $resource = RentedRoomResource::class;

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

    protected function handleRecordUpdate(Model $record, array $data): Model
    {

        $lamaSewa = $data['rent_time'];

        if (isset($data['rent_time'])) {
            Tagihan::where('rented_room_id', $record->id)->where('due_date', Carbon::parse($record->rent_time))->update([
                "due_date" => Carbon::parse($lamaSewa),
            ]);

            Tagihan::where('rented_room_id', $record->id)->where('due_date', Carbon::parse($record->rent_time)->addDays(25))->update([
                "due_date" => Carbon::parse($lamaSewa),
            ]);

            $record->rent_time = $lamaSewa;
        }
        return $record;
    }
}
