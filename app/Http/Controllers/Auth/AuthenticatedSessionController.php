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
    public function create(): View|RedirectResponse
    {   
        if (Auth::check()) {
            // Ambil data user yang sedang login
            $user = Auth::user();
            // Periksa apakah ada NIM (untuk mahasiswa)
            if ($user->nim) {
                // Jika ada NIM, anggap pengguna sebagai mahasiswa
                return redirect()->route('dashboard');
            }
        }
        if (Auth::guard('dosen')->check()) {
            $user = Auth::guard('dosen')->user();
            // Periksa NIP
            if ($user->nip) {
                return redirect()->route('dosen.dashboard');
            }
        }        
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        try {
            $request->authenticate();
            
            $request->session()->regenerate();
    
            return redirect()->intended(route('dashboard', absolute: false));
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->with('loginError', 'Email atau kata sandi yang Anda masukkan salah!');
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
