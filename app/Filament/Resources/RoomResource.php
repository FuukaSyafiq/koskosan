<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RoomResource\Pages;
use App\Filament\Resources\RoomResource\RelationManagers;
use App\Models\Permission;
use App\Models\Role;
use App\Models\Room;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Filament\Forms\Components\TextInput;
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

class RoomResource extends Resource
{
  protected static ?string $model = Room::class;

  protected static ?string $navigationIcon = 'heroicon-c-home-modern';

  protected static ?string $navigationGroup = 'Room management';

  public static function canCreate(): bool
    {
        return auth()->user()->role->id !==Role::getIdByRole('PENYEWA');
    }

    public static function canEdit(Model $record): bool
    {
        return auth()->user()->role->id !==Role::getIdByRole('PENYEWA');
    }

    public static function canDelete(Model $record): bool
    {
        return auth()->user()->role->id !==Role::getIdByRole('PENYEWA');
    }

    public static function canDeleteAny(): bool
    {
        return auth()->user()->role->id !==Role::getIdByRole('PENYEWA');
    }

  
  public static function form(Form $form): Form
  {
    return $form
      ->schema([
        Section::make('')
          ->schema([
            TextInput::make('name')
              ->label('nama ruang'),
            TextInput::make('price')
              ->label('Harga')
              ->prefix('Rp.')
              ->suffix('/Bulan'),
            TextArea::make('description')
              ->label('deskripsi')
              ->autosize()
              ->maxLength(255),
            TextInput::make('facility')
              ->label('fasilitas'),
            TextInput::make('address')
              ->label('address'),
          ])
          ->columns(2),
        Section::make('Foto ')
          ->schema([
            FileUpload::make('images')
              ->multiple()->directory("Image") // Enable multiple file uploads
              ->image() // Specify that the upload is for images
              ->required() // Optional: Make the field required
              ->maxFiles(4)
          ]),
        Section::make('VR Upload')
          ->schema([
            FileUpload::make('vr_files')->directory("VR")
              ->acceptedFileTypes(['.vr', '.gltf', '.glb', '.fbx']) // Tentukan format file yang diterima
          ]),
      ]);
  }

  public static function table(Table $table): Table
  {

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
            return $rentedRoom ? \App\Models\User::find($rentedRoom->user_id)?->name ?? '' : '';
          }),
        TextColumn::make('price')
          ->label('Harga'),
          // ->prefix('Rp.'),
        TextColumn::make('description')
          ->label('deskripsi')
          ->limit(50),
        TextColumn::make('facility')
          ->label('fasilitas'),
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
      'index' => Pages\ListRooms::route('/'),
      'create' => Pages\CreateRoom::route('/create'),
      'edit' => Pages\EditRoom::route('/{record}/edit'),
    ];
  }
}
