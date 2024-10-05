<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TagihanResource\Pages;
use App\Filament\Resources\TagihanResource\RelationManagers;
use App\Models\Tagihan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;

class TagihanResource extends Resource
{
    protected static ?string $model = Tagihan::class;

    protected static ?string $navigationIcon = 'heroicon-c-banknotes';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                  ->schema([
                    Select::make('rented_room_id')
                    ->label('Kamar')
                    ->relationship(
                        name: 'rentedRoom', 
                        titleAttribute: 'rooms.name', // Access the room name through the rentedRoom relationship
                        modifyQueryUsing: fn (Builder $query) => $query->join('rooms', 'rented_rooms.room_id', '=', 'rooms.id')
                                                                     ->where('rooms.available', false)
                    )
                    ->required(),
                      TextInput::make('amount')
                        ->label('Jumlah Tagihan')
                        ->required()
                        ->prefix('Rp.'),
                      DatePicker::make('due_date')
                        ->label('Tanggal jatuh tempo')
                        ->required()
                      ])->columns(2)
                    ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('rentedRoom.room.name')->label('Room Name'),
                TextColumn::make('amount')
                    ->label('Jumlah tagihan'),
                TextColumn::make('due_date')
                    ->label('Tanggal'),

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
            'index' => Pages\ListTagihans::route('/'),
            'create' => Pages\CreateTagihan::route('/create'),
            'edit' => Pages\EditTagihan::route('/{record}/edit'),
        ];
    }
}
