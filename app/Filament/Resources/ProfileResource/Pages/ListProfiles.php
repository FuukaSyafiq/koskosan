<?php

namespace App\Filament\Resources\ProfileResource\Pages;

use App\Filament\Resources\ProfileResource;
use App\Models\Role;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;

class ListProfiles extends ListRecords
{
    protected static string $resource = ProfileResource::class;

    public function mount(): void
    {
        parent::mount();
        $user = auth()->user();
        if ($user->role->id === Role::getIdByRole('PENYEWA') && !$user->ktp_url) {
            Notification::make()
                ->title('Perhatian: KTP Belum Lengkap')
                ->body('Untuk menyewa ruang kos diharuskan untuk melengkapi foto KTP dengan menghubungi pemilik kos.')
                ->warning()
                ->persistent()
                ->send();
        }
        redirect(ProfileResource::getUrl('edit', ['record' => $user->id]));
    }
}
