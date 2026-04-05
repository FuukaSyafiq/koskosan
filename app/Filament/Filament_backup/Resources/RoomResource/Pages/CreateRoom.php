<?php

namespace App\Filament\Resources\RoomResource\Pages;

use App\Helpers\DeleteImages;
use App\Helpers\StoreImages;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\File\File;

class CreateRoom extends CreateRecord
{
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

            $imagePath = null;
            if (isset($data['image']) && $data['image'] instanceof File) {
                $imagePath = StoreImages::StoreImages($data['image'], 'Room');
            }

            $imageVrPath = null;
            if (isset($data['image_vr']) && $data['image_vr'] instanceof File) {
                $imageVrPath = StoreImages::StoreImages($data['image_vr'], 'Room/VR');
            }

            $record = static::getModel()::create([
                'name' => $data['name'],
                'available' => true,
                'description' => $data['description'],
                'address' => $data['address'],
                'tipe_room_id' => $data['tipe_room_id'],
                'image' => $imagePath,
                'image_vr' => $imageVrPath,
            ]);

            DB::commit();

            return $record;
        } catch (\Exception $e) {
            DB::rollBack();
            if ($imagePath) {
                DeleteImages::DeleteImages($imagePath);
            }
            if ($imageVrPath) {
                DeleteImages::DeleteImages($imageVrPath);
            }
            Log::error('Error creating Room: '.$e->getMessage());
            throw $e;
        }
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
