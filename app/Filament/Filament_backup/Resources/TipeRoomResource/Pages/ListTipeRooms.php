<?php

namespace App\Filament\Resources\TipeRoomResource\Pages;

use App\Filament\Resources\TipeRoomResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTipeRooms extends ListRecords
{
    protected static string $resource = TipeRoomResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
