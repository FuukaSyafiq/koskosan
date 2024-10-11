<?php

namespace App\Filament\Resources\RoomResource\Pages;

use App\Filament\Resources\RoomResource;
use App\Models\Image;
use Filament\Actions;
use \Illuminate\Database\Eloquent\Model;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class EditRoom extends EditRecord
{
    protected static string $resource = RoomResource::class;

    public function handleRecordUpdate(Model $record, array $data): Model
    {

        try {
            DB::beginTransaction();
            if (isset($data['images'])) {
                $previousImages = Image::where('room_id', $record->id)->get();
                foreach ($previousImages as $previousImage) {
                    DeleteImages($previousImage->file_name);
                }

                foreach ($data['images'] as $image) {
                    StoreImages($image, $record->id);
                }
            }

            if (isset($data['vr_files'])) {
                $previousVr = Image::where('room_id', $record->id)->where('is_vr', true)->first();

                DeleteImages($previousVr->file_name);

                StoreImages($data['vr_files'], $record->id, null, true);
            }

            DB::commit();
            return $record;
        } catch (\Exception $e) {
            // Rollback the transaction on error

            foreach ($data['images'] as $image) {
                DeleteImages($image);
            }
            DB::rollBack();

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
