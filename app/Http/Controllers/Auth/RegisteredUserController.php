<?php

namespace App\Http\Controllers\Auth;

use App\Models\Kecamatan;
use App\Models\Role;
use App\Models\User;
use App\Models\Agama;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\GolonganDarah;
use App\Models\KartuKeluarga;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FilesController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\DataPendaftar;
use App\Models\Kelurahan;
use App\Models\Files;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(RegisterRequest $request)
    {

        $user = DataPendaftar::create(attributes: [
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => Role::getIdByRole('WARGA'),
            'nomor_telepon' => $request->phone,
            'password' => Hash::make($request->password),
        ]);


        // event(new Registered($user));
        // Auth::login($user);
        return redirect('/')->with('konfirmasi', 1);
    }
}
