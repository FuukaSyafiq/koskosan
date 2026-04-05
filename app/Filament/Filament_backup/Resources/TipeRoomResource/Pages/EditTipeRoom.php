<?php

namespace App\Filament\Resources\TipeRoomResource\Pages;

use App\Filament\Resources\TipeRoomResource;
use App\Helpers\DeleteImages;
use App\Helpers\StoreImages;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\File\File;

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
            $imagePath = $record->image;

            if (isset($data['image'])) {
                $file = $data['image'];
                if ($file instanceof File) {
                    if ($imagePath) {
                        DeleteImages::DeleteImages($imagePath);
                    }
                    $imagePath = StoreImages::StoreImages($file, 'TipeRoom');
                }
            }

            $record->update([
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
            Log::error('Error updating Tipe Room: '.$e->getMessage());
            throw $e;
        }
    }
}
