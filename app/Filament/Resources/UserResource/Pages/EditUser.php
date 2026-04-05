<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Helpers\DeleteImages;
use App\Helpers\StoreImages;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\File\File;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function handleRecordUpdate(Model $record, array $data): Model
    {
        try {
            DB::beginTransaction();

            $ktpUrl = $record->ktp_url;
            if (isset($data['ktp_url']) && $data['ktp_url'] instanceof File) {
                if ($ktpUrl) {
                    DeleteImages::DeleteImages($ktpUrl);
                }
                $ktpUrl = StoreImages::StoreImages($data['ktp_url'], 'KTP');
            }

            $record->update([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'contact' => $data['contact'],
                'address' => $data['address'],
                'ktp_url' => $ktpUrl,
            ]);

            DB::commit();

            return $record;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error updating User: '.$e->getMessage());
            throw $e;
        }
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
