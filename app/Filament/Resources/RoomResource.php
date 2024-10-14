<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RoomResource\Pages;
use App\Filament\Resources\RoomResource\RelationManagers;
use App\Helpers\DeleteImages;
use App\Models\Image;
use App\Models\Permission;
use App\Models\Role;
use App\Models\TipeRoom;
use App\Models\Room;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Model;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Components\Tab;
use Filament\Forms\Components\Section;
use Filament\Forms\Get;
use Filament\Forms\Components\Toggle;
use Illuminate\Database\Eloquent\Collection;

class RoomResource extends Resource
{
  protected static ?string $model = Room::class;

  protected static ?string $navigationIcon = 'heroicon-c-home-modern';

  protected static ?string $navigationGroup = 'Room management';
  public static function canCreate(): bool
  {
    return auth()->user()->role->id !== Role::getIdByRole('PENYEWA');
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


  public static function form(Form $form): Form
  {
    $currentTipeRoomId = request()->route('record')
      ? Room::find(request()->route('record'))->tipe_room_id
      : null;

    return $form
      ->schema([
        Section::make('')
          ->schema([
            TextInput::make('name')
              ->required()
              ->label('nama ruang'),
            Select::make('tipe_room_id')
              ->label('Tipe Ruang')
              ->required()
              ->relationship('tipe_room', 'tipe')
              ->reactive()  // Makes the select reactive
              ->afterStateUpdated(function (callable $set, $state) {
                // Fetch the related tipe_room details when tipe_room_id is updated
                $tipeRoom = TipeRoom::find($state);

                if ($tipeRoom) {
                  $set('price', $tipeRoom->price);
                  $set('facility', $tipeRoom->facility);
                } else {
                  $set('price', null);
                  $set('facility', null);
                }
              }),
            TextInput::make('price')
              ->required()
              ->label('Harga')
              ->prefix('Rp.')
              // ->placeholder(function () use ($currentTipeRoomId) {
              //   // Fetch the TipeRoom based on the currentTipeRoomId
              //   $tipeRoom = $currentTipeRoomId ? TipeRoom::find($currentTipeRoomId) : null;
              //   return $tipeRoom ? $tipeRoom->price : null;
              // })
              ->readOnly(true)
              ->suffix('/Bulan'),
            TextInput::make('facility')
              ->required()
              ->readOnly(true)
              // ->placeholder(function () use ($currentTipeRoomId) {
              //   // Fetch the TipeRoom based on the currentTipeRoomId
              //   $tipeRoom = $currentTipeRoomId ? TipeRoom::find($currentTipeRoomId) : null;
              //   return $tipeRoom ? $tipeRoom->facility : null;
              // })
              ->label('fasilitas'),
            TextArea::make('description')
              ->required()
              ->label('deskripsi')
              ->autosize()
              ->maxLength(255),
            TextInput::make('address')
              ->required()
              ->label('address'),
          ])
          ->columns(2),
        Section::make('Foto')
          ->schema([
            FileUpload::make('images')
              ->directory("Image") // Enable multiple file uploads
              ->image() // Specify that the upload is for images
              ->required() // Optional: Make the field required
              ->required(fn($livewire) => !$livewire->record)
              ->maxFiles(5)
              ->multiple()
          ]),
        Section::make('VR Upload')
          ->schema([
            FileUpload::make('vr_files')->directory("VR")->maxSize(99999999999)
            // ->acceptedFileTypes(['.jpg', '.JPEG', '.png', '.jpeg']) // Tentukan format file yang diterima
          ]),
      ]);
  }

  public static function table(Table $table): Table
  {
    // $allRoomsAvailable = Room::where('available', false)->doesntExist();

    return $table
      ->columns([
        TextColumn::make('name')
          ->label('nama ruang'),
        BooleanColumn::make('available')
          ->label('tersedia'),
        TextColumn::make('')
          ->label('Penyewa')
          ->getStateUsing(function ($record) {
            // Fetch the rented_room record based on the room_id and get the user_id
            $rentedRoom = \App\Models\RentedRoom::where('room_id', $record->id)->first();

            // If a rented_room is found, get the user's name from the user_id, otherwise return an empty string
            return $rentedRoom ? \App\Models\User::find($rentedRoom->user_id)?->name ?? '' : '-';
          }),
        TextColumn::make('tipe_room.tipe')
          ->label('Tipe Kamar'),
        TextColumn::make('tipe_room.price')
          ->label('Harga'),
        TextColumn::make('tipe_room.facility')
          ->label('fasilitas'),
        TextColumn::make('description')
          ->label('deskripsi')
          ->limit(50),
      ])
      ->filters([
        //
      ])
      ->actions([
        Tables\Actions\EditAction::make(),
      ])
      ->bulkActions([
        Tables\Actions\BulkActionGroup::make([
          Tables\Actions\DeleteBulkAction::make()->requiresConfirmation()->color('danger')
            ->action(function (Collection $records) {
              foreach ($records as $record) {
                // Temukan gambar terkait berdasarkan tipe_room_id
                $image = Image::where('room_id', $record->id)->first();

                // Hapus file gambar menggunakan helper DeleteImages (pastikan helper sudah ada)
                if ($image) {
                  DeleteImages::DeleteImages($image->file_name);
                }

                // Hapus record dari tabel
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
      'index' => Pages\ListRooms::route('/'),
      'create' => Pages\CreateRoom::route('/create'),
      'edit' => Pages\EditRoom::route('/{record}/edit'),
    ];
  }
}
