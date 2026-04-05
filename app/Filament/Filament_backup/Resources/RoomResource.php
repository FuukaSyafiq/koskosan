<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RoomResource\Pages;
use App\Helpers\DeleteImages;
use App\Models\Role;
use App\Models\Room;
use App\Models\TipeRoom;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class RoomResource extends Resource
{
    protected static ?string $model = Room::class;

    protected static ?string $navigationIcon = 'heroicon-c-home-modern';

    protected static ?string $navigationGroup = 'Room management';

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
                Section::make('')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->label('nama ruang'),
                        Select::make('tipe_room_id')
                            ->label('Tipe Ruang')
                            ->required()
                            ->relationship('tipe_room', 'tipe')
                            ->reactive()
                            ->afterStateUpdated(function (callable $set, $state) {
                                $tipeRoom = TipeRoom::find($state);
                                if ($tipeRoom) {
                                    $set('price', $tipeRoom->price);
                                    $set('facility', $tipeRoom->facility);
                                } else {
                                    $set('price', null);
                                    $set('facility', null);
                                }
                            }),
                        TextInput::make('price')
                            ->required()
                            ->label('Harga')
                            ->prefix('Rp.')
                            ->readOnly(true)
                            ->suffix('/Bulan'),
                        TextInput::make('facility')
                            ->required()
                            ->readOnly(true)
                            ->label('fasilitas'),
                        TextArea::make('description')
                            ->required()
                            ->label('deskripsi')
                            ->autosize()
                            ->maxLength(255),
                        TextInput::make('address')
                            ->required()
                            ->label('address'),
                    ])
                    ->columns(2),
                Section::make('Foto')
                    ->schema([
                        FileUpload::make('image')
                            ->directory('Room')
                            ->image()
                            ->disk('s3'),
                    ]),
                Section::make('VR Upload')
                    ->schema([
                        FileUpload::make('image_vr')
                            ->directory('Room/VR')
                            ->disk('s3'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('nama ruang'),
                BooleanColumn::make('available')
                    ->label('tersedia'),
                ImageColumn::make('image')
                    ->size(50)
                    ->label('Foto')
                    ->disk('s3'),
                TextColumn::make('')
                    ->label('Penyewa')
                    ->getStateUsing(function ($record) {
                        $rentedRoom = \App\Models\RentedRoom::where('room_id', $record->id)->first();

                        return $rentedRoom ? \App\Models\User::find($rentedRoom->user_id)?->name ?? '' : '-';
                    }),
                TextColumn::make('tipe_room.tipe')
                    ->label('Tipe Kamar'),
                TextColumn::make('tipe_room.price')
                    ->label('Harga'),
                TextColumn::make('description')
                    ->label('deskripsi')
                    ->limit(50),
                TextColumn::make('address')
                    ->label('address'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()->requiresConfirmation()->color('danger')
                        ->action(function (Collection $records) {
                            foreach ($records as $record) {
                                if ($record->image) {
                                    DeleteImages::DeleteImages($record->image);
                                }
                                if ($record->image_vr) {
                                    DeleteImages::DeleteImages($record->image_vr);
                                }
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
            'index' => Pages\ListRooms::route('/'),
            'create' => Pages\CreateRoom::route('/create'),
            'edit' => Pages\EditRoom::route('/{record}/edit'),
        ];
    }
}
