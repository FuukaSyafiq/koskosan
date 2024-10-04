<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\Permission;
use App\Models\User;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Table;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Components\Tab;
use Filament\Forms\Components\Section;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    private static function checkPermission(string $action): bool
    {
        $permission = Permission::getPermissionByUserAndPermissionAndAction('User', $action);
        return isset($permission) && $permission->action;
    }

    // Check if the user can view any data
    public static function canViewAny(): bool
    {
        $canView = self::checkPermission('READ');
        if (!$canView) {
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
    public static function canDelete(Model $record): bool
    {
        if (!self::canViewAny()) {
            return false;
        }
        return self::checkPermission('DELETE');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Data diri')
                    ->schema([
                        TextInput::make('name')
                            ->label('nama penyewa')
                            ->required(),
                        TextInput::make('address')
                            ->label('Alamat')
                            ->required(),
                        TextInput::make('contact')
                            ->label('Kontak')
                            ->required(),
                        TextInput::make('email')
                            ->email()
                            ->required(),
                        TextInput::make('password')
                            ->password()
                            ->required(),
                    ])->columns(2),
                Section::make('lampiran')
                    ->schema([
                        FileUpload::make('ktp_id')
                        // ->required()    
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            // ->modifyQueryUsing(function ($query) {
            //     return $query->where('');
            // })
            ->columns([
                TextColumn::make('name')
                    ->label('nama penyewa'),
                TextColumn::make('email')
                    ->label('email'),
                TextColumn::make('balance')
                    ->label('saldo'),
                TextColumn::make('address')
                    ->label('Alamat'),
                TextColumn::make('contact')
                    ->label('Kontak'),
                ImageColumn::make('ktp_id')
                    ->label('KTP')
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
