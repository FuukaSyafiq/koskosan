<?php

namespace App\Filament\Resources\RoomResource\Pages;

use App\Filament\Resources\RoomResource;
use App\Helpers\DeleteImages;
use App\Helpers\StoreImages;
use App\Models\TipeRoom;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\File\File;

class EditRoom extends EditRecord
{
    protected static string $resource = RoomResource::class;

    protected function mutateFormDataBeforeFill(array $data): array
    {
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

            $imagePath = $record->image;
            if (isset($data['image']) && $data['image'] instanceof File) {
                if ($imagePath) {
                    DeleteImages::DeleteImages($imagePath);
                }
                $imagePath = StoreImages::StoreImages($data['image'], 'Room');
            }

            $imageVrPath = $record->image_vr;
            if (isset($data['image_vr']) && $data['image_vr'] instanceof File) {
                if ($imageVrPath) {
                    DeleteImages::DeleteImages($imageVrPath);
                }
                $imageVrPath = StoreImages::StoreImages($data['image_vr'], 'Room/VR');
            }

            $record->update([
                'name' => $data['name'],
                'tipe_room_id' => $data['tipe_room_id'],
                'description' => $data['description'],
                'address' => $data['address'],
                'image' => $imagePath,
                'image_vr' => $imageVrPath,
            ]);

            DB::commit();

            return $record;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error updating Room: '.$e->getMessage());
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
