<?php

namespace App\Filament\Resources\TransactionResource\Pages;

use App\Filament\Resources\TransactionResource;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Select;
use App\Models\VerifikasiPembayaran;
use App\Models\Role;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

use Filament\Tables\Actions\ModalAction;


class ListTransactions extends ListRecords
{
    protected static string $resource = TransactionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            //ACTION FOR OWNER
            // Actions\ButtonAction::make('Cetak Semua Transaksi')
            //     ->url(fn() => route('transaction.all.pdf'))
            //     ->openUrlInNewTab()
            //     ->visible(fn() => auth()->user()->role_id === Role::getIdByRole("OWNER")&& VerifikasiPembayaran::where('is_valid', true)->exists()),

                //ACTION FOR PENYEWA
                Actions\ButtonAction::make('Cetak Semua Transaksi')
                ->url(fn() => route('transaction.all.user.pdf'))
                ->visible(fn() => auth()->user()->role_id === Role::getIdByRole("PENYEWA") && VerifikasiPembayaran::where('pengirim', auth()->user()->name)->where('is_valid', true)->exists())
                ->openUrlInNewTab(),

                Actions\ButtonAction::make('Cetak Semua Transaksi')
                ->form([
                    Select::make('pengirim')
                        ->label('Select Pengirim')
                        ->options(
                            VerifikasiPembayaran::distinct()->pluck('pengirim', 'pengirim') // Fetch distinct pengirim values
                                ->prepend('All', 'all') // Add 'all' as an additional option
                        )
                        ->required(),
                ])
                ->action(function (array $data) {
                    // Handle the logic based on the selected 'pengirim'
                    if ($data['pengirim'] === 'all') {
                        $transactions = VerifikasiPembayaran::where('is_valid', true)->get();
                    } else {
                        $transactions = VerifikasiPembayaran::where('pengirim', $data['pengirim'])
                                                            ->where('is_valid', true)
                                                            ->get();
                    }
            
                    // Assuming you redirect or handle PDF generation based on $transactions
                    // Example: Redirect to a custom route for PDF generation
                    return redirect()->route('transaction.select.user.pdf', ['records' => $transactions]);
                })
        ];
    }

    public function getBreadcrumb(): string
    {
        return '';
    }

    public function getTitle(): string
    {
        return 'Transaction history';
    }
}
