<?php

namespace App\Filament\Resources\DataPetugasResource\Pages;

use App\Filament\Resources\DataPetugasResource;
use Filament\Actions;
use App\Models\Role;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Filament\Notifications\Notification;
use App\Models\User;

class ListDataPetugas extends ListRecords
{
    protected static string $resource = DataPetugasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
        ];
    }

    public function getTabs(): array
    {
        $tabs = [
            'semua' => Tab::make()->query(function ($query) {
                $query->where('role_id', "!=", Role::getIdByRole("WARGA"));
            }),
        ];

        // Ambil semua role dari tabel roles
        $roles = Role::where('role', "!=", "WARGA")->get();

        // Buat tab secara dinamis berdasarkan role yang ada
        foreach ($roles as $role) {
            $tabs[$role->role] = Tab::make()
                ->label($role->role) // Set label sesuai nama role
                ->modifyQueryUsing(fn($query) => $query->where('role_id', $role->id)); // Filter berdasarkan role_id
        }

        return $tabs;
    }

    protected function getActiveTab(): ?string
    {
        return 'semua'; // Default tab to be selected
    }

    public function getTitle(): string
    {
        return 'Data Petugas';
    }
}
