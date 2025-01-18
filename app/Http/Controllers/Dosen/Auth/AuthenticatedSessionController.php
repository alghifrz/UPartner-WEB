<?php

namespace App\Http\Controllers\Dosen\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\DosenLoginRequest;
use App\Models\Dosen;
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
        if (Auth::check()) {
            $user = Auth::user();
    
            // Periksa apakah ada NIP (untuk dosen)
            if ($user->nip) {
                // Jika ada NIP, anggap pengguna sebagai dosen
                return redirect()->route('dosen.dashboard');
            }
            // Periksa apakah ada NIM (untuk mahasiswa)
            elseif ($user->nim) {
                // Jika ada NIM, anggap pengguna sebagai mahasiswa
                return redirect()->route('dashboard');
            }
        }
        return view('dosen.auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(DosenLoginRequest $request): RedirectResponse
    {
        try {
            $request->authenticate();
            
            $request->session()->regenerate();
    
            return redirect()->intended(route('dosen.dashboard', absolute: false));
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->with('loginError', 'Email atau kata sandi yang Anda masukkan salah!');
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('dosen')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
