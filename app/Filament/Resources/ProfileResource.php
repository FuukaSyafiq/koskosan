<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProfileResource\Pages;
use App\Models\Role;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Builder;

class ProfileResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';
    
    protected static ?string $navigationLabel = 'Profil Saya';
    
    protected static ?string $slug = 'my-profile';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Pribadi')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama Lengkap')
                            ->required(),
                        TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true),
                        TextInput::make('contact')
                            ->label('Nomor Kontak')
                            ->required(),
                        TextInput::make('address')
                            ->label('Alamat/Asal')
                            ->required(),
                    ])->columns(2),

                Section::make('Ubah Password')
                    ->description('Kosongkan jika tidak ingin mengubah password')
                    ->schema([
                        TextInput::make('password')
                            ->password()
                            ->label('Password Baru')
                            ->dehydrated(fn ($state) => filled($state))
                            ->dehydrateStateUsing(fn ($state) => Hash::make($state)),
                        TextInput::make('password_confirmation')
                            ->password()
                            ->label('Konfirmasi Password Baru')
                            ->same('password')
                            ->requiredWith('password'),
                    ])->columns(2),
                Section::make('lampiran')
                    ->hidden(fn() => auth()->user()->role->id === Role::getIdByRole('OWNER'))
                    ->schema([
                        FileUpload::make('ktp_url')
                            ->label('KTP')
                            ->image()
                            ->hidden(fn() => auth()->user()->role->id === Role::getIdByRole('OWNER'))
                            ->directory('KTP')
                            ->disk('s3')
                            ->disabled()
                            ->helperText('KTP hanya bisa diubah oleh Pemilik Kos (Owner).'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Nama'),
                Tables\Columns\TextColumn::make('email')->label('Email'),
            ])
            ->modifyQueryUsing(fn (Builder $query) => $query->where('id', auth()->id()))
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProfiles::route('/'),
            'edit' => Pages\EditProfile::route('/{record}/edit'),
        ];
    }
    
    public static function canCreate(): bool
    {
        return false;
    }

    public static function canDelete($record): bool
    {
        return false;
    }
}
