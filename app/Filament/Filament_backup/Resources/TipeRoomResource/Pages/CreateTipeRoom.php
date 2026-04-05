<?php

namespace App\Filament\Resources\TipeRoomResource\Pages;

use App\Filament\Resources\TipeRoomResource;
use App\Helpers\DeleteImages;
use App\Helpers\StoreImages;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\File\File;

class CreateTipeRoom extends CreateRecord
{
    protected static string $resource = TipeRoomResource::class;

    protected function getFormActions(): array
    {
        return [
            $this->getCreateFormAction()->label('Buat'),
            $this->getCancelFormAction()->label('Batal'),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    public function handleRecordCreation(array $data): Model
    {
        DB::beginTransaction();
        try {
            $imagePath = null;
            if (isset($data['image'])) {
                $file = $data['image'];
                if ($file instanceof File) {
                    $imagePath = StoreImages::StoreImages($file, 'TipeRoom');
                }
            }

            $record = static::getModel()::create([
                'tipe' => $data['tipe'],
                'facility' => $data['facility'],
                'ukuran' => $data['ukuran'],
                'price' => $data['price'],
                'image' => $imagePath,
            ]);

            DB::commit();

            return $record;
        } catch (\Exception $e) {
            DB::rollBack();
            if (isset($imagePath)) {
                DeleteImages::DeleteImages($imagePath);
            }
            Log::error('Error creating Tipe Room: '.$e->getMessage());
            throw $e;
        }
    }
}
