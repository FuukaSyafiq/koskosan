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
use App\Models\VerifikasiPembayaran;
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

    // redirect user ke Tabel tagihan lagi
    protected function getRedirectUrl(): string
    {
        return \App\Filament\Resources\TagihanResource::getUrl('index');
    }

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
        DB::beginTransaction();
        $user = User::where('name', $data['user'])->first();

        try {
            // dd($data);
            $roomYangDisewa = Room::where('name', $data['room'])->first();
            $rentedRoom = RentedRoom::where('room_id', $roomYangDisewa->id)->where('user_id', $user->id)->first();

            if ($user->role_id === Role::getIdByRole('OWNER')) {


                // $roomYangDisewa = Room::where('id', $rentedRoom->room_id)->first();

                Tagihan::where('rented_room_id', $rentedRoom->id)->where('is_settled', false)->where('id', $data['due_date'])
                    ->update([
                        "is_settled" => true,
                        "tanggal_dibayar" => $data['tanggal_dibayar']
                    ]);

                $tagihanJatuhtempoTerakhir = Tagihan::where('rented_room_id', $rentedRoom->id)->orderBy('due_date', 'desc')->first();


                Tagihan::create([
                    "amount" => $data['tagihan'],
                    "rented_room_id" => $rentedRoom->id,
                    "is_settled" => false,
                    "tanggal_dibayar" => null,
                    "due_date" => Carbon::parse($tagihanJatuhtempoTerakhir->due_date)->addDays(30),  // 30 days after current due_date
                    "tanggal_notif" => Carbon::parse($tagihanJatuhtempoTerakhir->due_date)->addDays(25),  // 25 days from now
                ]);

                $noInvoice = GenerateInvoiceNumber();

                $buktiPembayaran = StoreImages($data['invoice_file']);
                // $invoiceFile = $this->store($data['invoice_file']);

                VerifikasiPembayaran::create([
                    "is_valid" => true,
                    "pengirim" => $user->name,
                    "amount" => $data['tagihan'],
                    "tanggal_dibayar" => Carbon::now('utc'),
                    "room" => $roomYangDisewa->name,
                    "no_invoice" => $noInvoice,
                    "bukti_file" => $buktiPembayaran->id
                ]);

                DB::commit();
                return $user;
            }

            $roomYangDisewa = Room::where('id', $rentedRoom->room_id)->first();

            $noInvoice = GenerateInvoiceNumber();

            $buktiFile =  StoreImages($data['invoice_file']);

            VerifikasiPembayaran::create([
                "is_valid" => false,
                "amount" => $data['tagihan'],
                "tanggal_dibayar" => Carbon::now('utc'),
                "pengirim" => $user->name,
                "room" => $roomYangDisewa->name,
                "no_invoice" => $noInvoice,
                "bukti_file" => $buktiFile->id
            ]);


            DB::commit();
            return $user;
        } catch (\Exception $e) {
            DeleteImages($data['invoice_file']);
            DB::rollBack();


            throw $e;
        }
    }

    protected function getFormActions(): array
    {
        return [
            $this->getCreateFormAction()->label('Bayar'),
            $this->getCancelFormAction()->label('Batal'),
        ];
    }
}
