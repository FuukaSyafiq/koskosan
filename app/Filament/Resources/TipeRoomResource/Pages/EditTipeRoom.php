<?php

namespace App\Filament\Resources\TipeRoomResource\Pages;

use App\Filament\Resources\TipeRoomResource;
use App\Helpers\DeleteImages;
use App\Helpers\StoreImages;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\File\File;

class EditTipeRoom extends EditRecord
{
    protected static string $resource = TipeRoomResource::class;

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

}
