<?php

namespace App\Http\Controllers\Dosen\Auth;

use App\Models\Dosen;
use App\Models\Prodi;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $prodi = Prodi::all();
        return view('dosen.auth.register', compact('prodi'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nip' => ['required', 'string', 'max:6', 'min:6', 'unique:dosens,nip'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.Dosen::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'prodi_id' => ['required', 'integer', 'exists:prodis,id'],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:4096'],
            'bio' => ['nullable', 'string', 'max:4096'],
        ]);

        $fileName = '/img/profile.png';
        
        $bio = 'Selamat datang di profil saya!';
        $kontribusi = null;

        $dosen = Dosen::create([
            'nip' => $request->nip,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'prodi_id' => $request->prodi_id,
            'photo' => $fileName,
            'bio' => $bio
        ]);

        event(new Registered($dosen));

        // Auth::guard('dosen')->login($dosen);

        return redirect()->route('dosen.login')->with('success', 'Berhasil mendaftar! Silahkan login.');

    }
}
