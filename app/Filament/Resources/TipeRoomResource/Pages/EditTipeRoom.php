<?php

namespace App\Filament\Resources\TipeRoomResource\Pages;

use App\Filament\Resources\TipeRoomResource;
use App\Helpers\DeleteImages;
use App\Helpers\StoreImages;
use App\Models\Image;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use \Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class EditTipeRoom extends EditRecord
{
    protected static string $resource = TipeRoomResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function handleRecordUpdate($record, array $data): Model
    {
        DB::beginTransaction();

        try {
            if (isset($data['image'])) {
                $image = Image::where('tipe_room_id', $record->id)->first();
                DeleteImages::DeleteImages($image->file_name);

                StoreImages::StoreImages($data['image'], null, $record->id);
            }

            $record->update([
                "tipe" => $data['tipe'],
                "facility" => $data['facility'],
                "ukuran" => $data['ukuran'],
                "price" => $data['price']
            ]);

            DB::commit();
            return $record;
        } catch (\Exception $e) {
            // Rollback the transaction on error
            DB::rollBack();

            DeleteImages::DeleteImages($data['image']);

            // Log the error message
            Log::error('Error creating Tipe Room: ' . $e->getMessage());

            // Rethrow the exception or handle it as needed
            throw $e;
        }
    }
}
