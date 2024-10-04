<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DataPetugasResource\Pages;
use App\Filament\Resources\DataPetugasResource\RelationManagers;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\CheckboxColumn;
use App\Models\DataPendaftar;
use App\Models\User;
use Filament\Tables\Filters\Filter;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Illuminate\Support\Facades\Log;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Components\Tab;
use Filament\Forms\Components\Section;
use Closure;
use App\Models\Permission;
use Illuminate\Database\Eloquent\Model;
use App\Models\Role;
use App\Models\Files;
use App\Models\KartuKeluarga;



class DataPetugasResource extends Resource
{
    protected static ?string $model = DataPendaftar::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Master';

    protected static ?string $navigationLabel = 'Data Petugas';

    private static function checkPermission(string $action): bool
    {
        $permission = Permission::getPermissionByUserAndPermissionAndAction('DATAPETUGAS', $action);
        return isset($permission) && $permission->action;
    }

    // Check if the user can view any data
    public static function canViewAny(): bool
    {
        $canView = self::checkPermission('READ');
        if (!$canView) {
            redirect('/operator');
            return false;
        }
        return true;
    }

    // Check if the user can create
    public static function canCreate(): bool
    {
        if (!self::canViewAny()) {
            return false;
        }
        return self::checkPermission('CREATE');
    }

    // Check if the user can edit
    public static function canEdit(Model $record): bool
    {
        if (!self::canViewAny()) {
            return false;
        }
        return self::checkPermission('UPDATE');
    }

    // Check if the user can delete
    public static function canDeleteAny(): bool
    {
        if (!self::canViewAny()) {
            return false;
        }
        return self::checkPermission('DELETE');
    }
    public static function canDelete(Model $record ): bool
    {
        if (!self::canViewAny()) {
            return false;
        }
        return self::checkPermission('DELETE');
    }
    //permission handling end

    public static function getBreadcrumb(): string
    {
        return 'Data Petugas';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Data diri')
                    ->description('Data diri Petugas')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->label('Nama'),
                        TextInput::make('email')
                            ->email()
                            ->unique(ignoreRecord: True)
                            ->required()
                            ->label('Email'),
                        Select::make('role_id')
                            ->relationship('role', 'role')
                            ->options(
                                Role::where('role', '!=', 'WARGA')->pluck('role', 'id')
                            )
                            // ->hidden()
                            // ->default(1)
                            ->required()
                            ->label('Role'),
                        Radio::make('terverifikasi')
                            ->label('terverifikasi')
                            ->boolean()
                            ->required()
                            ->default(true)
                            ->hidden(),
                        TextInput::make('nomor_induk_kependudukan')
                            ->rules([
                                function () {
                                    return function (string $attribute, $value, Closure $fail) {
                                        // Check if the value exceeds the maximum length
                                        if (strlen((string) $value) > 16) {
                                            $fail("Input tidak boleh melebihi 16 digit.");
                                        }

                                        // Check if the value is numeric
                                        if (!is_numeric($value)) {
                                            $fail("Input Tidak boleh mengandung huruf");
                                        }
                                        //warning when input is not numeric and exceed maximum length
                                        // if (!is_numeric($value && strlen((string) $value) > 16)) {
                                        //     $fail("Input harus berupa angka dan tidak boleh melebihi 16 digit.");
                                        // }
                                    };
                                },
                            ])
                            ->unique(ignoreRecord: true)
                            ->required()
                            ->label('NIK'),
                        TextInput::make('kartu_keluarga_nomor')
                            ->label('Nomor KK')
                            ->afterStateUpdated(function ($state, callable $set) {
                                // Find kartu_keluarga_id by nomor
                                $kartuKeluarga = KartuKeluarga::where('nomor', $state)->first();
                                
                                if ($kartuKeluarga) {
                                    // Set kartu_keluarga_id
                                    $set('kartu_keluarga_id', $kartuKeluarga->id);
                                }
                            }),
                        Select::make('anggota_keluarga_id')
                            ->relationship('anggota_keluarga', 'name')
                            ->required()
                            ->label('Anggota keluarga'),
                        TextInput::make('tempat_lahir')
                            ->required()
                            ->label('Tempat lahir'),
                        DatePicker::make('tanggal_lahir')
                            ->required()
                            ->label('Tanggal lahir'),
                        TextInput::make('nomor_telepon')
                            ->rules([
                                function () {
                                    return function (string $attribute, $value, Closure $fail) {
                                        // Check if the value exceeds the maximum length
                                        if (strlen((string) $value) > 13) {
                                            $fail("Nomer telepon tidak boleh melebihi 13 digit.");
                                        }

                                        // Check if the value is numeric
                                        if (!is_numeric($value)) {
                                            $fail("Nomer telepon harus berupa angka.");
                                        }
                                        //warning when input is not numeric and exceed maximum length
                                        // if (!is_numeric($value && strlen((string) $value) > 13)) {
                                        //     $fail("Nomer telepon harus berupa angka dan tidak boleh melebihi 13 digit.");
                                        // }
                                    };
                                },
                            ])
                            ->required()
                            ->label('No telepon'),
                        Select::make('agama_id')
                            ->required()
                            ->relationship('agama', 'agama')
                            ->label('Agama'),
                        Select::make('kelamin')
                            ->required()
                            ->options([
                                'laki-laki' => 'Laki-laki',
                                'perempuan' => 'Perempuan',
                            ])
                            ->label('Jenis kelamin'),
                        Select::make('golongan_darah_id')
                            ->required()
                            ->relationship('golonganDarah', 'darah')
                            ->label('Golongan darah'),
                        Select::make('status_nikah')
                            ->required()
                            ->options([
                                'belum nikah' => 'Belum Kawin',
                                'nikah' => 'Kawin',
                                'cerai hidup' => 'Cerai Hidup',
                                'cerai mati' => 'Cerai Mati',
                            ])
                            ->label('Status perkawinan'),
                        Select::make('kewarganegaraan')
                            ->required()
                            ->options([
                                'WNI' => 'WNI',
                                'WNA' => 'WNA',
                            ])
                            ->label('Kewarganegaraan'),
                        Select::make('kecamatan_id')
                            ->required()
                            ->relationship('kecamatan', 'name')
                            ->label('Kecamatan')
                            ->reactive() // Membuat kecamatan_id menjadi reaktif
                            ->afterStateUpdated(fn(callable $set) => $set('kelurahan_id', null)), // Reset kelurahan ketika kecamatan berubah

                        Select::make('kelurahan_id')
                            ->required()
                            ->label('Kelurahan')
                            ->options(function ($get) {
                                $kecamatanId = $get('kecamatan_id'); // Mendapatkan kecamatan_id yang dipilih
                                if ($kecamatanId) {
                                    $kelurahan = \App\Models\Kelurahan::where('kecamatan_id', $kecamatanId)->pluck('name', 'id');
                                    return $kelurahan;
                                }
                                return []; // Jika kecamatan belum dipilih, dropdown kelurahan kosong
                            })
                            ->reactive() // Agar kelurahan_id refresh ketika kecamatan berubah
                            ->disabled(fn($get) => $get('kecamatan_id') == null),

                        TextInput::make('rw')
                            ->required()
                            ->maxLength(3)
                            ->label('RW'),
                        TextInput::make('rt')
                            ->required()
                            ->maxLength(3)
                            ->label('RT'),
                        Textarea::make('alamat')
                            ->required()
                            ->label('Alamat'),
                        TextInput::make('password')
                            ->password()
                            ->revealable()
                            ->required()
                            ->label('Password'),
                    ])->columns(2),
                Section::make('Lampiran')
                    ->description('Lampiran KTP dan KK asli (berupa foto)')
                    ->schema([
                        FileUpload::make('KTP')
                            ->label('foto KTP'),
                        FileUpload::make('KK')
                            ->label('foto KK'),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->emptyStateHeading('Tidak ada data Petugas')
            ->columns([
                TextColumn::make('name')->label('Nama')->sortable()->searchable(),
                TextColumn::make('email')->label('Email')->sortable()->searchable(),
                TextColumn::make('role.role')->label('Role')->sortable(),
                iconColumn::make('terverifikasi')->label('Terverifikasi')->boolean(),
                TextColumn::make('nomor_induk_kependudukan')->label('NIK'),
                // TextColumn::make('kartu_keluarga_id')->label('KK'),
                TextColumn::make('kecamatan.name')->label('Kecamatan'),
                TextColumn::make("kelurahan.name")->label('Kelurahan'),
                TextColumn::make('rw')->label('RW'),
                TextColumn::make('rt')->label('RT'),
                ImageColumn::make('ktp_id')
                    ->label('KTP')
                    ->getStateUsing(function ($record) {
                        // Call the custom method to get the file path by data_pendaftar_id
                        $file = Files::getPathFileByDataPendaftarId($record->id);

                        // Check if a file is returned and then create a URL to the path
                        return $file ? url($file->path) : null;
                    })
                    ->height(50)
                    ->width(100),
                ImageColumn::make('kartu_keluarga_id')
                    ->label('KK')
                    ->getStateUsing(function ($record) {
                        // Call the custom method to get the file path for KK by data_pendaftar_id
                        $file = Files::getKKPathByDataPendaftarId($record->id);

                        // Check if a file is returned and then create a URL to the path
                        return $file ? url($file->path) : null;
                    })
                    ->height(50)
                    ->width(100),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDataPetugas::route('/'),
            'create' => Pages\CreateDataPetugas::route('/create'),
            'edit' => Pages\EditDataPetugas::route('/{record}/edit'),
        ];
    }
}
