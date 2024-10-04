<?php

namespace App\Filament\Resources\TagihanResource\Pages;

use App\Filament\Resources\TagihanResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTagihan extends CreateRecord
{
    protected static string $resource = TagihanResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Check if due_date is set and not null
        if (isset($data['due_date'])) {
            // Create a Carbon instance from the due_date
            $dueDate = \Carbon\Carbon::parse($data['due_date']);
            // Subtract 5 days to get tanggal_notif
            $data['tanggal_notif'] = $dueDate->subDays(5)->toDateString(); // or toDateTimeString() if you want a full datetime
        } else {
            // Handle the case where due_date is not set
            $data['tanggal_notif'] = null; // or any default value you want
        }

        return $data;
    }
}
