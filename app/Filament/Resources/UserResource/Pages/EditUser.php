<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\Image;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use \Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    private function store($filename): Image
    {
        $fileDB = Image::create([
            'file_name' => $filename,
            'mime_type' => null,
            'path' => '/storage' . '/' . $filename,
            'size' => null,
        ]);
        return $fileDB;
    }

    public function handleRecordUpdate($record, array $data): Model
    {
        try {
            
            if (isset($data['ktp_id'])) {
                DB::beginTransaction();
                $ktp = $this->store($data['ktp_id']);

                User::where('email', $record->email)->update(['ktp_id' => $ktp->id]);
                DB::commit();
            }

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
