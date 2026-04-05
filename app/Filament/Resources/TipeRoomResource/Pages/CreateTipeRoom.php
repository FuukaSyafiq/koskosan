<?php

namespace App\Filament\Resources\TipeRoomResource\Pages;

use App\Filament\Resources\TipeRoomResource;
use App\Helpers\DeleteImages;
use App\Helpers\StoreImages;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\File\File;

class CreateTipeRoom extends CreateRecord
{
    protected static string $resource = TipeRoomResource::class;

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
