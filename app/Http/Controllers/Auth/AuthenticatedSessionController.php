<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $akun = Auth::user();

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

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
