<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TopupResource\Pages;
use App\Filament\Resources\TopupResource\RelationManagers;
use App\Models\User;
use App\Models\Role;
// use App\Models\Saldo;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TopupResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationGroup = 'Financial Transactions';

    public static function getBreadcrumb(): string
    {
        return '';
    }

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';
    protected static ?string $navigationLabel = 'Top up';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('balance')->label('Saldo'),
                Select::make('user_id')->label('user')
                    ->visible(fn($get) => auth()->user()->role_id === Role::getIdByRole("OWNER"))->options(User::where('role_id', Role::getIdByRole("PENYEWA"))->pluck('name', 'id')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            // ->columns([]) // No columns
            // ->actions([]) // No actions
            ->actions([
                Tables\Actions\CreateAction::make()
                    ->createAnother(false),
            ]);
        // ->bulkActions([]); // No bulk actions
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
            'index' => Pages\CreateTopup::route('/'),  // Arahkan index ke halaman create langsung
            // 'create' => Pages\CreateTopup::route('/create'),  // Simpan rute create
            // 'edit' => Pages\EditTopup::route('/{record}/edit'),  // Edit top-up jika diperlukan
        ];
    }
}
