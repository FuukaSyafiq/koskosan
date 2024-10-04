<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            '' => Tab::make()
                ->modifyQueryUsing(fn($query) => $query->where('role_id', 1))
        ];
    }

    // protected function getActiveTab(): ?string
    // {
    //     return 'warga'; // Default tab to be selected
    // }
}
