<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RentedRoomResource\Pages;
use App\Models\RentedRoom;
use App\Models\Room;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Infolist;

class RentedRoomResource extends Resource
{
    protected static ?string $model = RentedRoom::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('room_id')
                    ->relationship(
                        name: 'room',
                        titleAttribute: 'name', // Mengakses nama ruangan melalui relasi
                        modifyQueryUsing: fn(Builder $query) => $query->where('available', true) // Hanya ambil ruangan yang tersedia
                    )->required()
                    ->afterStateUpdated(function ($state, $set) {
                        // Ambil harga dari ruangan yang dipilih
                        $room = Room::find($state); // Mengambil ruangan berdasarkan ID

                        if ($room) {
                            // Set harga ruangan jika ditemukan
                            $set('price', $room->price); // Ganti 'price' dengan nama state yang sesuai
                        } else {
                            // Jika ruangan tidak ditemukan, set harga menjadi null
                            $set('price', null); // Atau $set('price', 0);
                        }
                    })->reactive(),
                Select::make('user_id')
                    ->relationship(
                        name: 'user',
                        titleAttribute: 'name',
                        modifyQueryUsing: fn(Builder $query, $get) => $query
                            ->whereHas('role', fn($q) => $q->where('role', 'PENYEWA')) // Hanya pengguna dengan peran "PENYEWA"
                            ->when($get('price'), function ($query, $price) {
                                // Menggunakan harga yang diset dalam state sebagai batasan
                                $query->where('balance', '>=', $price); // Hanya pengguna dengan saldo yang cukup
                            })
                    )->required()
                    ->label('Penyewa')->disabled(fn($get) => $get('price') == null),
                DatePicker::make('rent_time')
                    ->label('Waktu Awal Sewa')->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')->label('Penyewa'),
                TextColumn::make('room.name')->label('Kamar'),
                TextColumn::make('rent_time')->label('Waktu Awal Sewa')
                    ->formatStateUsing(fn($state) => Carbon::parse($state)->translatedFormat('d F Y')),
            ])
            ->filters([
                // Tambahkan filter jika diperlukan
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
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
            // Tambahkan relasi jika ada
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRentedRooms::route('/'),
            'create' => Pages\CreateRentedRoom::route('/create'),
            'edit' => Pages\EditRentedRoom::route('/{record}/edit'),
            'view' => Pages\ViewRentedRoom::route('/{record}'),
        ];
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                TextEntry::make('user.name')->label('Nama Penyewa'),
                TextEntry::make('room.name')->label('Kamar'),
                TextEntry::make('rent_time')->label('Waktu Awal Sewa'),
            ]);
    }
}
