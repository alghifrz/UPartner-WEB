<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use App\Models\Footer;
use Illuminate\View\View;
use Illuminate\Http\Request;
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
        return view('profile.edit', [
            'footer' => $footer,
            'user' => $request->user(),
        ]);
    }

    public function editprofile(Request $request): View
    {
        $footer = Footer::getData();
        return view('profile.editprofile', [
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
        
        if ($request->hasfile('photo')) {
            
    
            // Upload file baru
            $file = $request->file('photo');
            $file_name = time() . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $file_name);
            $request->user()->photo = 'uploads/' . $file_name;
        }
    
        // Reset email verification if email changed
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }
    
        $request->user()->bio = $request->input('bio');
        $request->user()->save();
    
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
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
