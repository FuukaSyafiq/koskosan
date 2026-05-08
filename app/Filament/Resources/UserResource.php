<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Helpers\DeleteImages;
use App\Models\Role;
use App\Models\User;
use Filament\Forms\Components\FileUpload;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-s-user';

    protected static ?int $navigationSort = 1;

    public static function getNavigationLabel(): string
    {
        if (auth()->user()->role->id === Role::getIdByRole('PENYEWA')) {
            return 'Profile';
        }

        return 'users';
    }

    public static function canView(Model $record): bool
    {
        return auth()->user()->role->id === Role::getIdByRole('OWNER') || auth()->id() === $record->id;
    }

    public static function canAccess(): bool
    {
        return true;
    }

    public static function canViewAny(): bool
    {
        return true;
    }

    public static function canCreate(): bool
    {
        return auth()->user()->role->id === Role::getIdByRole('OWNER');
    }

    public static function canEdit(Model $record): bool
    {
        return auth()->user()->role->id === Role::getIdByRole('OWNER') || auth()->id() === $record->id;
    }

    public static function canDeleteAny(): bool
    {
        return auth()->user()->role->id === Role::getIdByRole('OWNER');
    }

    public static function canDelete(Model $record): bool
    {
        return auth()->user()->role->id === Role::getIdByRole('OWNER');
    }

    public static function getTitle(): string
    {
        $user = request()->route('record');

        return "{$user->name} Data";
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
				->required(fn (string $context): bool => $context === 'create')
			->dehydrated(fn ($state) => filled($state))
			->dehydrateStateUsing(fn ($state) => Hash::make($state)),
                    ])->columns(2),
                Section::make('lampiran')
                    ->schema([
                        FileUpload::make('ktp_url')
                            ->label('KTP')
                            ->required(fn ($livewire) => ! $livewire->record)
                            ->directory('KTP')
                            ->disk('s3'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function ($query) {
                if (auth()->user()->role->id === Role::getIdByRole('PENYEWA')) {
                    return $query->where('id', auth()->id());
                }
                return $query->where('role_id', Role::getIdByRole('PENYEWA'));
            })
            ->columns([
                TextColumn::make('name')
                    ->label('nama penyewa'),
                TextColumn::make('email')
                    ->label('email'),
                TextColumn::make('address')
                    ->label('Alamat'),
                TextColumn::make('contact')
                    ->label('Kontak'),
                ImageColumn::make('ktp_url')
                    ->label('KTP')
                    ->disk('s3'),
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
                    Tables\Actions\DeleteBulkAction::make()->requiresConfirmation()->color('danger')
                        ->action(function (Collection $records) {
                            foreach ($records as $record) {
                                if ($record->ktp_url) {
                                    DeleteImages::DeleteImages($record->ktp_url);
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
            'view' => Pages\ViewUser::route('/{record}'),
        ];
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                TextEntry::make('name')
                    ->label('nama'),
                TextEntry::make('email')
                    ->label('email'),
                TextEntry::make('contact')
                    ->label('contact'),
                TextEntry::make('address')
                    ->label('Alamat'),
                ImageEntry::make('ktp_url')
                    ->label('KTP')
                    ->disk('s3')
                    ->width('100')
                    ->height('50'),
            ]);
    }
}
