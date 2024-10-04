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

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                  ->schema([
                      Select::make('rented_room_id')
                        ->label('Kamar')
                        ->required()
                        ->relationship(
                            name:'rentedRoom.room', 
                            titleAttribute:'name',
                            modifyQueryUsing: fn (Builder $query) => $query->whereHas('room', function ($query) {
                                $query->where('available', false);
                            })
                        ),
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
                TextColumn::make('rented_room.room.name')
                    ->label('Kamar'),
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
