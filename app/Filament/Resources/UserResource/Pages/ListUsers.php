<?php

namespace App\Filament\Resources\UserResource\Pages;
use App\Models\Role;
use App\Filament\Resources\UserResource;
use App\Models\User;
use Filament\Actions;
use Filament\Notifications\Notification;
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

    public function mount(): void
    {
        $user = auth()->user();
        $userRole = auth()->user()->role_id;
        if ($userRole === Role::getIdByRole('OWNER')) {
            $countMissingKtp = User::where('role_id', Role::getIdByRole('PENYEWA'))
                ->whereNull('ktp_url')
                ->count();
            if ($countMissingKtp > 0) {
                Notification::make()
                    ->title('Perhatian: Data KTP Belum Lengkap')
                    ->body("Terdapat {$countMissingKtp} penyewa yang belum memiliki data KTP. Harap segera lengkapi untuk validasi.")
                    ->warning()
                    ->send();
            }
        }
    }
}
