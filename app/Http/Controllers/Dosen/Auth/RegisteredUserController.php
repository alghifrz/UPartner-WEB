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
            'nip' => ['required', 'string', 'max:6', 'unique:dosens,nip'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.Dosen::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'prodi_id' => ['required', 'integer', 'exists:prodis,id'],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:4096'],
        ]);

        $fileName = '/img/profile.png';

        // Periksa apakah ada foto dan proses upload jika ada
        if (isset($input['photo']) && is_string($input['photo'])) {
            // Jika path foto ada, kita abaikan
            $fileName = null;
        } elseif (isset($input['photo']) && $input['photo']->isValid()) {
            // Jika file yang di-upload valid
            $file = $input['photo'];
            $fileName = time() . '_' . $file->getClientOriginalName();
            // Menyimpan file ke storage (public/uploads)
            $file->storeAs('public/uploads', $fileName);
        }

        $dosen = Dosen::create([
            'nip' => $request->nip,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'prodi_id' => $request->prodi_id,
            'photo' => $fileName
        ]);

        event(new Registered($dosen));

        Auth::guard('dosen')->login($dosen);

        return redirect(route('dosen.dashboard', absolute: false));
    }
}
