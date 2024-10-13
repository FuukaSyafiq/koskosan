<?php

namespace App\Filament\Resources\RoomResource\Pages;

use App\Filament\Resources\RoomResource;
use App\Helpers\DeleteImages;
use App\Helpers\StoreImages;
use App\Models\Image;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CreateRoom extends CreateRecord
{
    protected static string $resource = RoomResource::class;

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
            $record = static::getModel()::create([
                "name" => $data['name'],
                "available" => true,
                "description" => $data['description'],
                "address" => $data['address'],
                "tipe_room_id" => $data['tipe_room_id']
            ]);

            foreach ($data['images'] as $image) {
                StoreImages::StoreImages($image, $record->id);
            }

            if (isset($data['vr_files'])) {
                StoreImages::StoreImages($data['vr_files'], $record->id, null, true);
            }

            DB::commit();

            return $record;
        } catch (\Exception $e) {
            // Rollback the transaction on error 
            foreach ($data['images'] as $image) {
                DeleteImages::DeleteImages($image);
            }

            DB::rollBack();

            // Log the error message
            Log::error('Error creating DataPendaftar: ' . $e->getMessage());

            // Rethrow the exception or handle it as needed
            throw $e;
        }
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
