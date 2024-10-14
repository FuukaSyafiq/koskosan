<?php

namespace App\Filament\Resources\RoomResource\Pages;

use App\Filament\Resources\RoomResource;
use App\Helpers\DeleteImages;
use App\Helpers\StoreImages;
use App\Models\Image;
use App\Models\TipeRoom;
use Filament\Actions;
use \Illuminate\Database\Eloquent\Model;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class EditRoom extends EditRecord
{
    protected static string $resource = RoomResource::class;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Fetch the current TipeRoom using tipe_room_id
        $tipeRoom = TipeRoom::find($data['tipe_room_id'] ?? null);

        if ($tipeRoom) {
            $data['price'] = $tipeRoom->price;
            $data['facility'] = $tipeRoom->facility;
        }

        return $data;
    }

    public function handleRecordUpdate(Model $record, array $data): Model
    {

        try {
            DB::beginTransaction();
            if (isset($data['images'])) {
                $previousImages = Image::where('room_id', $record->id)->where('is_vr', false)->get();
                $panjangImage = count($previousImages);
                if ($panjangImage >= 6) {
                    foreach ($previousImages as $previousImage) {
                        DeleteImages::DeleteImages($previousImage->file_name);
                    }
                }

                foreach ($data['images'] as $image) {
                    StoreImages::StoreImages($image, $record->id, $data['tipe_room_id']);
                }
            }

            if (isset($data['vr_files'])) {
                $previousVr = Image::where('room_id', $record->id)->where('is_vr', true)->first();
                if (isset($previousVr)) {
                    DeleteImages::DeleteImages($previousVr->file_name);
                }
                StoreImages::StoreImages($data['vr_files'], $record->id, $data['tipe_room_id'], true);
            }

            $record->update([
                "name" => $data['name'],
                "tipe_room_id" => $data['tipe_room_id'],
                "description" => $data['description'],
                "address" => $data['address']
            ]);

            DB::commit();
            return $record;
        } catch (\Exception $e) {
            // Rollback the transaction on error

            DB::rollBack();
            foreach ($data['images'] as $image) {
                DeleteImages::DeleteImages($image);
            }

            // Log the error message
            Log::error('Error creating DataPendaftar: ' . $e->getMessage());

            // Rethrow the exception or handle it as needed
            throw $e;
        }
    }

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
}
