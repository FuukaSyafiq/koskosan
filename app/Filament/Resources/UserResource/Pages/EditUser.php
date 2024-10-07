<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\Image;
use App\Models\User;
use App\Models\Role;
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

    public function handleRecordUpdate(Model $record, array $data): Model
    {
        try {

            if (isset($data['ktp_id'])) {
                DB::beginTransaction();
                $ktp = $this->store($data['ktp_id']);

                User::where('email', $record->email)->update(['ktp_id' => $ktp->id]);
                DB::commit();
            }

            $record->update($data);
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

    public function mount($record): void
    {
        $userId = auth()->user()->id;
        $userRole = auth()->user()->role_id;

        if ($userRole === Role::getIdbyRole('PENYEWA')) {

            // Redirect dynamically to the appropriate URL
            redirect("/penyewa/users/{$userId}");
            // redirect("/{$roleName}/payments/create");
        }
        parent::mount($record);
    }
}
