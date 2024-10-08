<?php

namespace App\Filament\Resources\PaymentResource\Pages;

use App\Filament\Resources\PaymentResource;
use App\Models\RentedRoom;
use App\Models\Role;
use App\Models\Room;
use App\Models\Tagihan;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Image;
use App\Models\Invoice;
use Carbon\Carbon;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Filament\Pages\Actions\Action;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CreatePayment extends CreateRecord
{
    protected static string $resource = PaymentResource::class;

    private function store($filename): Image
    {
        $fileDB = Image::create([
            'file_name' => $filename,
            'mime_type' => null,
            'path' => '/storage' . '/' . $filename,
            'size' => null,
        ]);
        return $fileDB;
    }

    public  function getBreadcrumb(): string
    {
        return '';
    }

    public function getTitle(): string
    {
        return "Payments";
    }

    public function handleRecordCreation(array $data): Model
    {
        $user = auth()->user();

        try {
            // dd($data);
            DB::beginTransaction();
            if ($user->role_id === Role::getIdByRole('OWNER')) {
                $userId = (int) $data['user_id']; // Cast user_id to integer
                $user = User::where('id', $userId)->first();

                $rentedRoom = RentedRoom::where('room_id', $data['room_id'])->where('user_id', $user->id)->first();

                $roomYangDisewa = Room::where('id', $rentedRoom->room_id)->first();

                $tagihanYangAkanDibayar = Tagihan::where('rented_room_id', $rentedRoom->id)->update([
                    "is_settled" => true,
                    "tanggal_dibayar" => $data['tanggal_dibayar']
                ]);
                // dd($tagihanYangAkanDibayar);

                $tagihanJatuhtempoSekarang = Tagihan::where('id', $data['due_date'])->first();


                Tagihan::create([
                    "amount" => $data['tagihan'],
                    "rented_room_id" => $rentedRoom->id,
                    "is_settled" => false,
                    "tanggal_dibayar" => null,
                    "due_date" => Carbon::parse($tagihanJatuhtempoSekarang->due_date)->addDays(30),  // 30 days after current due_date
                    "tanggal_notif" => Carbon::parse($tagihanJatuhtempoSekarang->due_date)->addDays(25),  // 25 days from now
                ]);

                $noInvoice = GenerateInvoiceNumber();
                $invoiceFile = $this->store($data['invoice_file']);
                
                $invoice = Invoice::create([
                "no_invoice" => $noInvoice,
                "invoice_file" => $invoiceFile->id
            ]);

                Transaction::create([
                    "pengirim" => $user->name,
                    "room" => $roomYangDisewa->name,
                    "amount" => $data['tagihan'],
                    "tanggal_dibayar" => $data['tanggal_dibayar'],
                    "invoice_id" => $invoice->id,
                ]);


                DB::commit();
                return $user;
            }

            $rentedRoom = RentedRoom::where('room_id', $data['room_id'])->where('user_id', $user->id)->first();

            $roomYangDisewa = Room::where('id', $rentedRoom->room_id)->first();

            $noInvoice = GenerateInvoiceNumber();
                
            $invoiceFile = $this->store($data['invoice_file']);

            Invoice::create([
                "no_invoice" => $noInvoice,
                "invoice_file" => $invoiceFile->id
            ]);

          
            DB::commit();
            return $user;
        } catch (\Exception $e) {
            DB::rollBack();

            throw $e;
        }
    }

    protected function getFormActions(): array
    {
        return [
            $this->getCreateFormAction()->label('Bayar'),
        ];
    }
}
