<?php

namespace App\Filament\Resources\RoomResource\Pages;

use App\Filament\Resources\RoomResource;
use App\Models\Image;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CreateRoom extends CreateRecord
{
    protected static string $resource = RoomResource::class;

    private function store($filename, $roomId = null, $isVr = false): Image
    {
        $fileDB = Image::create([
            'file_name' => $filename,
            'mime_type' => null,
            'path' => '/storage' . '/' . $filename,
            'size' => null,
            "room_id" => $roomId,
            "is_vr" => $isVr
        ]);
        return $fileDB;
    }

    // protected function mutateFormDataBeforeCreate(array $data): array
    // {
    //     //otomatis 'available true karena room yang baru diinput ibu kos pasti tersedia'
    //     $data['available'] = true;
    //     $data['address'] = "KosLoka Ibu Qosim";
    //     return $data;
    // }


    public function handleRecordCreation(array $data): Model
    {

        try {
            DB::beginTransaction();
            $record = static::getModel()::create([
                "name" => $data['name'],
                "available" => true,
                "price" => $data['price'],
                "description" => $data['description'],
                "facility" => $data['facility'],
                "address" => $data['address']
            ]);

            foreach ($data['images'] as $image) {
                $this->store($image, $record->id);
            }

            if (isset($data['vr_files'])) {
                $this->store($data['vr_files'], $record->id, true);
            }

            DB::commit();

            return $record;
        } catch (\Exception $e) {
            // Rollback the transaction on error
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
