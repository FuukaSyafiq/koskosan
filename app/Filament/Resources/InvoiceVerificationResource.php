<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InvoiceVerificationResource\Pages;
use App\Filament\Resources\InvoiceVerificationResource\RelationManagers;
use App\Models\InvoiceVerification;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InvoiceVerificationResource extends Resource
{
    protected static ?string $model = InvoiceVerification::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            'index' => Pages\ListInvoiceVerifications::route('/'),
            'create' => Pages\CreateInvoiceVerification::route('/create'),
            'edit' => Pages\EditInvoiceVerification::route('/{record}/edit'),
        ];
    }
}
