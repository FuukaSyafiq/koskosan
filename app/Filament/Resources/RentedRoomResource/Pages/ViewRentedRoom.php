<?php

namespace App\Filament\Resources\RentedRoomResource\Pages;

use App\Filament\Resources\RentedRoomResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewRentedRoom extends ViewRecord
{
    protected static string $resource = RentedRoomResource::class;

    public function getTitle(): string
    {
        $room = $this->record; // Access the current record
        return "{$room->room->name}"; // Customize the title
    }
}
