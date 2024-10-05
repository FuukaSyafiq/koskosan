<?php

namespace App\Filament\Resources\RoomResource\Pages;

use App\Filament\Resources\RoomResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateRoom extends CreateRecord
{
    protected static string $resource = RoomResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        //otomatis 'available true karena room yang baru diinput ibu kos pasti tersedia'
        $data['available'] = true;
        $data['address'] = "KosLoka Ibu Qosim";
        return $data;
        
    }

    protected function getRedirectUrl(): string
{
    return $this->getResource()::getUrl('index');
}
}
