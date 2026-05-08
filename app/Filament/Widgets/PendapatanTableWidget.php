<?php

namespace App\Filament\Widgets;

use App\Models\Pendapatan;
use App\Models\Role;
use Filament\Tables;
use  Illuminate\Database\Eloquent\Collection;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Facades\Log;

class PendapatanTableWidget extends BaseWidget
{

    use InteractsWithPageFilters;

    protected static ?int $sort = 3; // Agar muncul di bawah Chart
    protected int | string | array $columnSpan = 'full'; // Agar lebar penuh

public static function canView(): bool
    {
        return auth()->user()?->role?->role === 'OWNER';
    }
	    public function table(Table $table): Table
    {
        return $table
            ->query(function () {
                $filters = $this->filters;

                Log::info($this->filters['startDate'] ?? 'tidak ada tanggal mulai');
				return Pendapatan::query()
					// Filter Tanggal Mulai (jika diisi)
					->when(
						$filters['startDate'] ?? null,
						fn($q, $date) => $q->whereDate('tanggal', '>=', $date)
					)
					// Filter Tanggal Selesai (jika diisi)
					->when(
						$filters['endDate'] ?? null,
						fn($q, $date) => $q->whereDate('tanggal', '<=', $date)
					);
            })
            ->columns([
                TextColumn::make('keuntungan')
                    ->label('Keuntungan')
                    ->money('IDR'),
                TextColumn::make('tanggal')
                    ->label('Tanggal')
                    ->date('d M Y'),
            ])->bulkActions([
            BulkAction::make('cetak')
                ->label('Cetak PDF')
                ->icon('heroicon-o-printer')
                ->color('success') // Hijau biasanya lebih cocok untuk cetak daripada merah (danger)
                ->action(function (Collection $records) {
                    $ids = $records->pluck('id')->toArray();

                    // Ambil tanggal dari kolom 'tanggal', bukan 'created_at' agar konsisten dengan filter
                    $startDate = $records->min('tanggal');
                    $endDate   = $records->max('tanggal');

                    // Generate URL
                    $url = route('pendapatan.cetak.pdf', [
                        'ids'        => implode(',', $ids),
                        'start_date' => $startDate,
                        'end_date'   => $endDate,
                    ]);

                    // Gunakan emit/dispatch atau redirect lewat browser
                    $this->redirect($url);
                }),
        ]);
    }
}
