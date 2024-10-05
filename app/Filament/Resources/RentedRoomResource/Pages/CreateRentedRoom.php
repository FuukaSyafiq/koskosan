<?php

namespace App\Filament\Resources\RentedRoomResource\Pages;

use App\Filament\Resources\RentedRoomResource;
use App\Models\Room;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateRentedRoom extends CreateRecord
{
    protected static string $resource = RentedRoomResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        // Create the rented room entry
        $rentedRoom = parent::handleRecordCreation($data);

        // Update the "available" column of the chosen room to false
        Room::where('id', $rentedRoom->room_id)->update(['available' => false]);

        return $rentedRoom;
    }

    protected function getRedirectUrl(): string
{
    return $this->getResource()::getUrl('index');
}
}
