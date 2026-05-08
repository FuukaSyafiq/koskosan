<?php
 
namespace App\Filament\Pages;
 
use Filament\Forms\Components\DatePicker;
use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Pages\Dashboard\Concerns\HasFiltersForm;
use Filament\Forms\Form;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;
use Illuminate\Support\Carbon;
 
class Dashboard extends BaseDashboard
{
    use HasFiltersForm; 
 
    public function filtersForm(Form $form): Form
    {
        return $form->schema([
            Section::make('Filter Tanggal')
                ->visible(fn() => auth()->user()?->role?->role === 'OWNER')
                ->schema([
                    Grid::make(2)
                        ->schema([
                            DatePicker::make('startDate')
                                ->label('Tanggal Mulai')
                                ->live()
                                ->native(false)
                                ->default(now()->startOfMonth())
                                ->displayFormat('d M Y'),
 
                            DatePicker::make('endDate')
                                ->label('Tanggal Selesai')
                                ->live()
                                ->native(false)
                                ->default(now()->endOfMonth())
                                ->displayFormat('d M Y'),
                        ])
                ])->collapsible(),
        ]);
    }
}
