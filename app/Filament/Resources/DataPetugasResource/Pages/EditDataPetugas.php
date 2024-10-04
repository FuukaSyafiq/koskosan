<?php

namespace App\Filament\Resources\DataPetugasResource\Pages;

use App\Filament\Resources\DataPetugasResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDataPetugas extends EditRecord
{
    protected static string $resource = DataPetugasResource::class;

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


    public function getTitle(): string
    {
        return 'Ubah Data Petugas';
    }
}
