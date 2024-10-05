<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RentedRoomResource\Pages;
use App\Filament\Resources\RentedRoomResource\RelationManagers;
use App\Models\RentedRoom;
use App\Models\Room;
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
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Infolists\Infolist;

class RentedRoomResource extends Resource
{
    protected static ?string $model = RentedRoom::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('user_id')
                ->relationship(
                    name: 'user', 
                    titleAttribute: 'name',
                    modifyQueryUsing: fn (Builder $query) => 
                        $query->whereHas('role', fn ($q) => $q->where('role', 'PENYEWA')) // Only users with role "PENYEWA"
                              ->whereDoesntHave('rentedRooms') // Exclude users who already have a rented room
                )
                    ->label('Penyewa'),
                    Select::make('room_id')
                    ->relationship(
                        name: 'room', 
                        titleAttribute: 'name', // Access the room name through the relationship
                        modifyQueryUsing: fn (Builder $query) => $query->where('available', true) // Only fetch rooms where available is true
                    )
                    ->required(),
                 DatePicker::make('rent_time')
                    ->label('waktu awal Sewa')   

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')->label('Penyewa'),
                TextColumn::make('room.name')->label('Kamar'),
                TextColumn::make('rent_time')->label('Waktu awal sewa'),
            ])
            ->filters([
                //
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRentedRooms::route('/'),
            'create' => Pages\CreateRentedRoom::route('/create'),
            'edit' => Pages\EditRentedRoom::route('/{record}/edit'),
            'view' => Pages\ViewRentedRoom::route('/{record}')
        ];
    }

    public static function infolist(Infolist $infolist): Infolist
{
    return $infolist
        ->schema([
            TextEntry::make('user.name')->label('nama Penyewa'),
            TextEntry::make('room.name')->label('kamar'),
            TextEntry::make('rent_time')->label('Waktu awal sewa'),
        ]);
}
}
