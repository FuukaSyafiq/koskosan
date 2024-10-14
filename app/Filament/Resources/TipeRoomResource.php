<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TipeRoomResource\Pages;
use App\Filament\Resources\TipeRoomResource\RelationManagers;
use App\Helpers\DeleteImages;
use App\Models\TipeRoom;
use App\Models\Role;
use Filament\Forms;
use App\Models\Image;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TipeRoomResource extends Resource
{
    protected static ?string $model = TipeRoom::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Room management';

    public static function canView(Model $record): bool
    {
        return auth()->user()->role->id !== Role::getIdByRole('PENYEWA');
    }
    public static function canViewAny(): bool
    {
        return auth()->user()->role->id !== Role::getIdByRole('PENYEWA');
    }
    public static function canCreate(): bool
    {
        return auth()->user()->role->id !== Role::getIdByRole('PENYEWA');
    }

    public static function canEdit(Model $record): bool
    {
        return auth()->user()->role->id !== Role::getIdByRole('PENYEWA');
    }

    public static function canDelete(Model $record): bool
    {
        return auth()->user()->role->id !== Role::getIdByRole('PENYEWA');
    }

    public static function canDeleteAny(): bool
    {
        return auth()->user()->role->id !== Role::getIdByRole('PENYEWA');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('tipe')
                    ->label('Nama Tipe'),
                TextInput::make('facility')
                    ->label('Fasilitas'),
                TextInput::make('ukuran')
                    ->label('Ukuran'),
                TextInput::make('price')
                    ->label('Harga')
                    ->prefix('Rp.')
                    ->suffix('/Bulan'),
                FileUpload::make('image')
                    ->required(fn($livewire) => !$livewire->record)
                    ->directory("Image") // Enable multiple file uploads
                    ->image() // Specify that the upload is for images
                // ->required() // Optional: Make the field required
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('tipe')
                    ->label('Nama Tipe'),
                TextColumn::make('facility')
                    ->label('Fasilitas'),
                TextColumn::make('ukuran')
                    ->label('Ukuran'),
                TextColumn::make('price')
                    ->label('Harga'),
                ImageColumn::make('')
                    ->size(50)
                    ->label('Foto Ruang')->getStateUsing(callback: function ($record) {
                        $image = Image::where('tipe_room_id', $record->id)->first();

                        // Check if $image is not null and has a path
                        return $image && $image->path ? url($image->path) : '';
                    })
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()->requiresConfirmation()
                        ->color('danger')->action(function (Collection $records) {
                            foreach ($records as $record) {
                                // Temukan gambar terkait berdasarkan tipe_room_id
                                $image = Image::where('tipe_room_id', $record->id)->first();

                                // Hapus file gambar menggunakan helper DeleteImages (pastikan helper sudah ada)
                                if ($image) {
                                    DeleteImages::DeleteImages($image->file_name);
                                }

                                // Hapus record dari tabel
                                $record->delete();
                            }
                        }),
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
            'index' => Pages\ListTipeRooms::route('/'),
            'create' => Pages\CreateTipeRoom::route('/create'),
            'edit' => Pages\EditTipeRoom::route('/{record}/edit'),
        ];
    }
}
