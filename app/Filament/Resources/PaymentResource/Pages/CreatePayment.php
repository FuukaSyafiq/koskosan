<?php

namespace App\Filament\Resources\PaymentResource\Pages;

use App\Filament\Resources\PaymentResource;
use App\Models\RentedRoom;
use App\Models\Role;
use App\Models\Tagihan;
use App\Models\Transaction;
use App\Models\User;
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
            if( $user->role_id === Role::getIdByRole('OWNER')) {
                $userId = (int) $data['user_id']; // Cast user_id to integer
                $user = User::find($userId);
            }

            // if ($user->balance < $data['tagihan']) {
            //     // Rollback the transaction if balance is insufficient
            //     DB::rollBack();
    
            //     // Trigger a warning notification and prevent form submission
            //     Notification::make() // Assuming you're using Laravel Filament for notifications
            //         ->warning()
            //         ->title('Saldo tidak cukup')
            //         ->body("Saldo Penyewa tidak mencukupi biaya tagihan,silahkan Top up Saldo.")
            //         ->send();
    
            //     throw new \Exception("User balance is insufficient.");
            // }

            User::where('id', $user->id)->update([
                'balance' => DB::raw("balance - {$data['tagihan']}")
            ]);

            $receiver =  User::where('role_id', Role::getIdByRole("OWNER"))->first();
            User::where('role_id', Role::getIdByRole("OWNER"))->update(["balance" => DB::raw("balance + {$data['tagihan']}")]);

            $rentedRoom = RentedRoom::where('room_id', $data['room_id'])->first();

            $tagihanSekarang = Tagihan::where('rented_room_id', $rentedRoom->id)->first();

            Tagihan::where('rented_room_id', $rentedRoom->id)->update([
                "is_settled" => true
            ]);

            $tagihanJatuhtempoSekarang = Tagihan::where('id', $data['due_date'])->first();

            Tagihan::create([
                "amount" => $data['tagihan'],
                "rented_room_id" => $rentedRoom->id,
                "is_settled" => false,
                "due_date" => Carbon::parse($tagihanJatuhtempoSekarang->due_date)->addDays(30),  // 30 days after current due_date
                "tanggal_notif" => Carbon::parse($tagihanJatuhtempoSekarang->due_date)->addDays(25),  // 25 days from now
            ]);

            Transaction::create([
                "sender_id" => $user->id,
                "receiver_id" => $receiver->id,
                "amount" => $data['tagihan']
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
