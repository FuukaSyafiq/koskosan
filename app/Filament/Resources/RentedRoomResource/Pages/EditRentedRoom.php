<?php

namespace App\Filament\Resources\RentedRoomResource\Pages;

use App\Filament\Resources\RentedRoomResource;
use Filament\Actions;
use App\Models\Room;
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
        // Get the current rented room
        $currentRoomId = $record->room_id;
    
        // Check if the room_id has changed
        if ($currentRoomId !== $data['room_id']) {
            // Set the old room as available
            Room::where('id', $currentRoomId)
                ->update(['available' => true]);
    
            // Set the new room as not available
            Room::where('id', $data['room_id'])
                ->update(['available' => false]);
        }
    
        // Call parent method to handle the actual update
        return parent::handleRecordUpdate($record, $data);
    }    
}
