<?php

namespace App\Filament\Resources\TopupResource\Pages;

use App\Filament\Resources\TopupResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CreateTopup extends CreateRecord
{
    protected static string $resource = TopupResource::class;

    public function getBreadcrumb(): string
    {
        return '';
    }

    public function getTitle(): string
    {
        return "Top up";
    }

    public  function handleRecordCreation(array $data): Model
    {
        // Dapatkan user yang sedang login
        $user = auth()->user();

        if (isset($data['user_id'])) {
            User::where('id', $data['user_id'])->update([
                'balance' => DB::raw("balance + {$data['balance']}")
            ]);

            return $user;
        }

        User::where('id', $user->id)->update([
            'balance' => DB::raw("balance + {$data['balance']}")
        ]);

        return $user;
    }

    protected function getFormActions(): array
    {
        return [
            $this->getCreateFormAction()->label('Konfirmasi'),
        ];
    }  
}
