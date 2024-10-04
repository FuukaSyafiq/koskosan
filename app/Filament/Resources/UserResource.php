<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use App\Models\Permission;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Illuminate\Database\Eloquent\Model;
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

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

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
                        TextInput::make('Contact')
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
                        ->required()    
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('nama penyewa'),
                TextColumn::make('email')
                    ->label('email'),
                TextColumn::make('balance')
                    ->email('saldo'),
                TextColumn::make('address')
                    ->label('Alamat'),
                TextColumn::make('Contact')
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
