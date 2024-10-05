<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RoomResource\Pages;
use App\Filament\Resources\RoomResource\RelationManagers;
use App\Models\Permission;
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

  private static function checkPermission(string $action): bool
  {
    $permission = Permission::getPermissionByUserAndPermissionAndAction('Room', $action);
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
          ])
          ->columns(2)
      ]);
  }

  public static function table(Table $table): Table
  {
    $kosId = 2;

    return $table
      // ->modifyQueryUsing(function ($query) use ($kosId) {
      //   return $query->where('available', true)->where('kos_id', $kosId);
      // })
      ->columns([
        TextColumn::make('name')
          ->label('nama ruang'),
        BooleanColumn::make('available')
          ->label('tersedia'),
        TextColumn::make('price')
          ->label('Harga'),
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
