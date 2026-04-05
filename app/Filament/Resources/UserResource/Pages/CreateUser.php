<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Helpers\DeleteImages;
use App\Helpers\StoreImages;
use App\Models\Role;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\File\File;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function getFormActions(): array
    {
        return [
            $this->getCreateFormAction()->label('Buat'),
            $this->getCancelFormAction()->label('Batal'),
        ];
    }

    public function handleRecordCreation(array $data): Model
    {
        try {
            DB::beginTransaction();

            $ktpUrl = null;
            if (isset($data['ktp_url']) && $data['ktp_url'] instanceof File) {
                $ktpUrl = StoreImages::StoreImages($data['ktp_url'], 'KTP');
            }

            $record = static::getModel()::create([
                'name' => $data['name'],
                'address' => $data['address'],
                'contact' => $data['contact'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'role_id' => Role::getIdByRole('PENYEWA'),
                'ktp_url' => $ktpUrl,
            ]);

            DB::commit();

            return $record;
        } catch (\Exception $e) {
            DB::rollBack();
            if ($ktpUrl) {
                DeleteImages::DeleteImages($ktpUrl);
            }
            Log::error('Error creating User: '.$e->getMessage());
            throw $e;
        }
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
