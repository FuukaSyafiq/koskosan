<?php

namespace App\Filament\Resources\RoomResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\File\File;

class CreateRoom extends CreateRecord
{
    protected static string $resource = \App\Filament\Resources\RoomResource::class;

    protected function getFormActions(): array
    {
        return [
            $this->getCreateFormAction()->label('Buat'),
            $this->getCancelFormAction()->label('Batal'),
        ];
    }

  
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
