<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Akun;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

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
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'Nama_Akun' => ['required', 'string', 'max:255', 'unique:akun'],
            'Password' => ['required', 'confirmed', Rules\Password::defaults()],
            'Id_Tim' => ['nullable', 'integer'],
            'Id_Korwil' => ['nullable', 'integer'],
            'Id_Mahasiswa' => ['nullable', 'integer'],
        ]);

        $akun = Akun::create([
            'Nama_Akun' => $request->Nama_Akun,
            'Password' => Hash::make($request->Password),
            'Id_Tim' => $request->Id_Tim,
            'Id_Korwil' => $request->Id_Korwil,
            'Id_Mahasiswa' => $request->Id_Mahasiswa,
        ]);

        event(new Registered($akun));

        Auth::login($akun);

        // Redirect to role-based dashboard after registration
        switch ($akun->role) {
            case 'mahasiswa':
                return redirect('/mahasiswa/dashboard');
            case 'korwil':
                return redirect('/korwil/dashboard');
            case 'tim':
                return redirect('/tim/dashboard');
            case 'dinas':
                return redirect('/dinas/dashboard');
            default:
                Auth::logout();
                abort(403, 'Role tidak dikenali.');
        }
    }
}
