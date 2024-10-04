<?php

namespace App\Filament\Resources\DataPetugasResource\Pages;

use App\Filament\Resources\DataPetugasResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use App\Models\KartuKeluarga;
use DB;
use App\Models\Files;

class CreateDataPetugas extends CreateRecord
{
    protected static string $resource = DataPetugasResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['terverifikasi'] = true;
        return $data;
    }

    private function store($filename)
    {
        $fileDB = Files::create([
            'file_name' => $filename,
            'mime_type' => null,
            'path' => '/storage//' . $filename,
            'disk' => 'public',
            'size' => null,
        ]);
        return $fileDB;
    }

    protected function handleRecordCreation(array $data): Model
    {
        try {

            DB::beginTransaction();
            // Create the DataPendaftar record
            $record = static::getModel()
                ::create([
                    "name" => $data['name'],
                    "email" => $data['email'],
                    "role_id" => $data['role_id'],
                    "nomor_induk_kependudukan" => $data['nomor_induk_kependudukan'],
                    "kartu_keluarga_id" => null,
                    "tempat_lahir" => $data['tempat_lahir'],
                    "tanggal_lahir" => $data['tanggal_lahir'],
                    "nomor_telepon" => $data['nomor_telepon'],
                    "ktp_id" => null,
                    "rw" => $data['rw'],
                    "rt" => $data['rt'],
                    "agama_id" => $data["agama_id"],
                    "terverifikasi" => true,
                    "kewarganegaraan" => $data["kewarganegaraan"],
                    "kelamin" => $data['kelamin'],
                    "status_nikah" => $data['status_nikah'],
                    "golongan_darah_id" => $data['golongan_darah_id'],
                    "kelurahan_id" => $data['kelurahan_id'],
                    "kecamatan_id" => $data['kecamatan_id'],
                    "alamat" => $data['alamat'],
                    "berlaku_hingga" => null,
                    "password" => Hash::make($data['password'])
                ]);

            //     // Handle KTP Upload
            $kk_files = $this->store($data['kartu_keluarga_id']);
            $ktp_files = $this->store($data['ktp_id']);

            $kk = KartuKeluarga::create([
                "nomor" => $data['kartu_keluarga_nomor'],
                "files_id" => $kk_files->id
            ]);

            $record->ktp_id = $ktp_files->id; // Set the ktp_id to the ID of the newly created file
            $record->kartu_keluarga_id = $kk->id;

            $record->save();

            $existingUser = User::where('email', $record->email)->first();

            if (!$existingUser) {
                // Create a new user entry in the users table
                User::create([
                    'name' => $record->name,
                    'email' => $record->email,
                    'nomor_induk_kependudukan' => $record->nomor_induk_kependudukan,
                    'role_id' => $record->role_id,
                    'data_pendaftar_id' => $record->id,
                    'password' => Hash::make($record->password), // Adjust password logic
                ]);
            }

            //     // Commit the transaction
            DB::commit();

            // INSERT INTO KARTU_KELUARGA start
                // Create a new KartuKeluarga record
                $kartuKeluarga = new KartuKeluarga();
                $kartuKeluarga->nomor = $data['kartu_keluarga_nomor'];

                // Save the new KartuKeluarga record to the database
                $kartuKeluarga->save();

                // Update DataPendaftar with the new kartu_keluarga_id
                $record->update([
                    'kartu_keluarga_id' => $kartuKeluarga->id
                ]);
            // INSERT INTO KARTU_KELUARGA end
            return $record;

        } catch (\Exception $e) {
            // Rollback the transaction on error
            DB::rollBack();

            // Log the error message
            \Log::error('Error creating DataPendaftar: ' . $e->getMessage());

            // Rethrow the exception or handle it as needed
            throw $e;
        }
    }

    // protected function handleRecordUpdate(Model $record, array $data): Model
    // {
    //     // Update the DataPendaftar record first
    //     $record->update($data);
    
    //     // Check if 'kartu_keluarga_nomor' is present in the updated data
    //     if (isset($data['kartu_keluarga_nomor'])) {
    //         // Check if the DataPendaftar record is already associated with a KartuKeluarga
    //         if ($record->kartu_keluarga) {
    //             \Log::info('Updating existing KartuKeluarga with ID: ' . $record->kartu_keluarga->id);
                
    //             // Update the existing KartuKeluarga record with the new nomor
    //             $record->kartu_keluarga->update([
    //                 'nomor' => $data['kartu_keluarga_nomor'],
    //             ]);
    
    //             \Log::info('KartuKeluarga updated with new nomor: ' . $data['kartu_keluarga_nomor']);
    //         } else {
    //             \Log::info('No existing KartuKeluarga found, creating a new one.');
    
    //             // Create a new KartuKeluarga record if not already associated
    //             $kartuKeluarga = new KartuKeluarga();
    //             $kartuKeluarga->nomor = $data['kartu_keluarga_nomor'];
    //             $kartuKeluarga->save();
    
    //             // Update DataPendaftar with the new kartu_keluarga_id
    //             $record->update([
    //                 'kartu_keluarga_id' => $kartuKeluarga->id,
    //             ]);
    
    //             Log::info('New KartuKeluarga created with ID: ' . $kartuKeluarga->id);
    //         }
    //     }
    
    //     return $record;
    // }
    
    

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    public function getTitle(): string
    {
        return 'Buat Data Petugas';
    }
}
