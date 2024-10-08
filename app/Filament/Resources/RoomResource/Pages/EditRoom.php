<?php

namespace App\Filament\Resources\RoomResource\Pages;

use App\Filament\Resources\RoomResource;
use App\Models\Image;
use Filament\Actions;
use \Illuminate\Database\Eloquent\Model;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EditRoom extends EditRecord
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


    public function handleRecordUpdate(Model $record, array $data): Model
    {

        try {

            DB::beginTransaction();
            if (isset($data['images'])) {
                Image::where('room_id', $record->id)->delete();
                foreach ($data['images'] as $image) {
                    $this->store($image, $record->id);
                }
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
