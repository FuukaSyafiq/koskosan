<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\StoreImages;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(RegisterRequest $request)
    {
        DB::beginTransaction();

        $ktpUrl = null;

        try {
            if ($request->hasFile('ktp')) {
                $file = $request->file('ktp');
                $ktpUrl = StoreImages::StoreImages($file, 'KTP');
            }

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'role_id' => Role::getIdByRole('PENYEWA'),
                'contact' => $request->contact,
                'address' => $request->address,
                'ktp_url' => $ktpUrl,
                'password' => Hash::make($request->password),
            ]);

            DB::commit();

            return redirect()->to('/login');
        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
    }
}
