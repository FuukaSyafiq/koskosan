<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PaymentResource\Pages;
use App\Models\RentedRoom;
use App\Models\Room;
use App\Models\User;
use App\Models\Role;
use App\Models\Tagihan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;

class PaymentResource extends Resource
{
    protected static ?string $model = User::class;

    public static function getBreadcrumb(): string
    {
        return '';
    }

    protected static ?string $navigationIcon = 'heroicon-s-document-duplicate';

    protected static ?string $navigationLabel = 'Payment';
    protected static ?string $navigationGroup = 'Financial Transactions';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('user_id')
    ->label('Penyewa')
    ->options(function () {
        // Fetch distinct user IDs from the RentedRoom table
        return RentedRoom::with('user') // Load related user data
            ->get()
            ->pluck('user.name', 'user_id'); // Get user names as values and user_ids as keys
    })
    ->visible(fn($get) => auth()->user()->role_id === Role::getIdByRole("OWNER")) // Only visible to "OWNER"
    ->reactive(), // Make it reactive to respond to changes

Select::make('room_id')
    ->label('Kamar')
    ->options(function ($get) {
        // Get the selected user_id from the form state, or fallback to the logged-in user
        $selectedUserId = $get('user_id') ?? auth()->user()->id;

        // Fetch the rooms rented by the selected user
        return RentedRoom::where('user_id', $selectedUserId) // Get rented rooms for the user
            ->with('room') // Load related room data
            ->get()
            ->pluck('room.name', 'room_id'); // Get room names as values and room_ids as keys
    })
    ->afterStateUpdated(function ($state, $set, $get) {
        // Find the rented room based on the selected room_id and user_id
        $selectedUserId = $get('user_id') ?? auth()->user()->id;
        $rentedRoom = RentedRoom::where('room_id', $state)
            ->where('user_id', $selectedUserId)
            ->first();

        if ($rentedRoom) {
            // Set the base price from the selected room
            $room = Room::find($state);
            $set('tagihan', $room->price); 

            // Fetch due dates of the tagihan associated with this rented room
            $dueDates = Tagihan::where('rented_room_id', $rentedRoom->id)
                ->where('is_settled', false)
                ->pluck('due_date', 'id');
            
            // Store due dates as options for the 'due_date' select field
            $set('due_dates_options', $dueDates);
        }
    })
    ->reactive()
    ->required(),

Select::make('due_date')
    ->label('Pilih Jatuh Tempo')
    ->options(fn($get) => $get('due_dates_options') ?? [])
    ->afterStateUpdated(function ($state, $set) {
        // Fetch the tagihan based on selected due date
        $tagihan = Tagihan::find($state);
        if ($tagihan) {
            // Update the tagihan amount based on the selected due date
            $set('tagihan', $tagihan->amount);
        }
    })
    ->reactive()
    ->required(),
                TextInput::make('tagihan')
                    ->label('Tagihan')
                    ->prefix("Rp.")
                    ->reactive()->required()->readOnly(true) // Make the field reactive to updates->
                    ->default(fn($get) => $get('tagihan'))
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table;
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\CreatePayment::route('/'),
            'create' => Pages\CreatePayment::route('/create'),
            // 'edit' => Pages\EditPayment::route('/{record}/edit'),
        ];
    }

    // public static function routes()
    // {
    //     return [
    //         'index' => function () {
    //             return redirect()->route('filament.resources.payment.create');
    //         },
    //         'edit' => function () {
    //             return redirect()->route('filament.resources.payment.create');
    //         },
    //     ];
    // }
}
