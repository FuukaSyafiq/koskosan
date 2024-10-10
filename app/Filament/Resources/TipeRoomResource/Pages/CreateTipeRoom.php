<?php

namespace App\Filament\Resources\TipeRoomResource\Pages;

use App\Filament\Resources\TipeRoomResource;
use Filament\Actions;
use App\Models\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Log;

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


    public function handleRecordCreation(array $data): Model
    {
        // dd($data);
        DB::beginTransaction();
        try {
            $record = static::getModel()::create([
                "tipe" => $data['tipe'],
                "facility" => $data['facility'],
                "ukuran" => $data['ukuran'],
                "price" => $data['price']
            ]);

            if (isset($data['image'])) {
                StoreImages($data['image'], null, $record->id);
            }
            $record->save();
            DB::commit();
            return $record;
        } catch (\Exception $e) {
            // Rollback the transaction on error
            DeleteImages($data['image']);
            DB::rollBack();

            // Log the error message
            Log::error('Error creating Tipe Room: ' . $e->getMessage());

            // Rethrow the exception or handle it as needed
            throw $e;
        }
    }
}
