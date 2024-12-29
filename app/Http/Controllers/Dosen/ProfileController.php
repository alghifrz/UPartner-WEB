<?php

namespace App\Http\Controllers\Dosen;

use App\Models\Prodi;
use App\Models\Footer;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $footer = Footer::getData();
        return view('dosen.profile.edit', [
            'footer' => $footer,
            'user' => $request->user(),
        ]);
    }

    public function editprofile(Request $request): View
    {
        $footer = Footer::getData();
        return view('dosen.profile.editprofile', [
            'footer' => $footer,
            'user' => $request->user(),
            'prodi' => Prodi::all(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());
        
        $filePath = public_path('uploads');
        if ($request->hasfile('photo')) {
            $file = $request->file('photo');
            $file_name = time() . $file->getClientOriginalName();
 
            $file->move($filePath, $file_name);
            $request->user()->photo = '/uploads/' . $file_name;
        }        

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->bio = $request->input('bio');


        $request->user()->save();

        return Redirect::route('dosen.profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
