<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RentedRoomResource\Pages;
use App\Models\RentedRoom;
use App\Models\Role;
use App\Models\Permission;
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
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class RentedRoomResource extends Resource
{
    protected static ?string $model = RentedRoom::class;

    protected static ?string $navigationIcon = 'heroicon-o-key';

    protected static ?string $navigationGroup = 'Room management';

    public static function getNavigationLabel(): string
    {
        if (auth()->user()->role->id === Role::getIdByRole('PENYEWA')) {
            return 'My Room'; // Change label for PENYEWA users
        }
        return 'Rented Room';
    }

    public static function canCreate(): bool
    {
        return true;
    }

    public static function canEdit(Model $record): bool
    {
        return auth()->user()->role->id !== Role::getIdByRole('PENYEWA');
    }

    public static function canDelete(Model $record): bool
    {
        return auth()->user()->role->id !== Role::getIdByRole('PENYEWA');
    }

    public static function canDeleteAny(): bool
    {
        return auth()->user()->role->id !== Role::getIdByRole('PENYEWA');
    }

    public static function canView(Model $record): bool
    {
        // Check if the user is a "PENYEWA"
        if (auth()->user()->role->id === Role::getIdByRole('PENYEWA')) {
            // Allow the user to view only their own rented room information
            return auth()->user()->id === $record->user_id; // Ensure you're comparing the correct user_id field
        }

        // If the role is "OWNER", allow viewing all rented rooms
        return true;
    }


    public static function form(Form $form, ?Model $record = null): Form

    {
        $currentRoomId = $record ? $record->room_id : null;
        // print_r($currentRoomId);
        return $form
            ->schema([
                Select::make('room_id')
                    ->relationship(
                        name: 'room',
                        titleAttribute: 'name', // Mengakses nama ruangan melalui relasi
                        modifyQueryUsing: fn(Builder $query, $get) => $query
                            ->where(function ($query) use ($get) {
                                $currentRoomId = $get('room_id'); // Get the current room_id from the model state
                                $query->where('available', true); // Only show available rooms

                                // Always include the currently selected room, even if it's not available
                                $query->orWhere('id', $currentRoomId);
                                // dd($currentRoomId);
                            })
                    )
                    ->required()
                    ->afterStateUpdated(function ($state, $set) use ($currentRoomId) {
                        // Ambil harga dari ruangan yang dipilih 
                        $room = Room::find($state); // Mengambil ruangan berdasarkan ID
                        // $currentRoomId = $record->room_id;
                        // dd($currentRoomId);
                        // dd($currentRoomId);
                        if ($room) {
                            // Set harga ruangan jika ditemukan
                            $set('price', $room->price); // Ganti 'price' dengan nama state yang sesuai
                        } else {
                            // Jika ruangan tidak ditemukan, set harga menjadi null
                            $set('price', null); // Atau $set('price', 0);
                        }
                    })
                    ->reactive(),
                Select::make('user_id')
                    ->relationship(
                        name: 'user',
                        titleAttribute: 'name',
                        modifyQueryUsing: fn(Builder $query, $get) => $query
                            ->whereHas('role', fn($q) => $q->where('role', 'PENYEWA')) // Hanya pengguna dengan peran "PENYEWA"
                    )->required()->visible(fn($get) => auth()->user()->role_id === Role::getIdByRole("OWNER"))
                    ->label('Penyewa')->disabled(fn($get) => $get('price') == null),
                DatePicker::make('rent_time')
                    ->label('Waktu Awal Sewa')
                    ->required()
                    ->minDate(now())
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function ($query) {
                if (auth()->user()->role_id == Role::getIdByRole("PENYEWA")) {
                    return $query->where('user_id', auth()->user()->id);
                }
                return $query;
            })
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
                Tables\Actions\DeleteAction::make()->after(function ($record) {
                    Room::where('id', $record->room_id)->update(["available" => true]);
                })
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->after(function ($records) {
                            // Loop through each record and update the related room
                            foreach ($records as $record) {
                                Room::where('id', $record->room_id)->update(['available' => true]);
                            }
                        })
                        ->requiresConfirmation(),
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
