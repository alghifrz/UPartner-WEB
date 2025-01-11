<?php
// File: app/Http/Controllers/Dosen/Proyek/ProjectController.php

namespace App\Http\Controllers\Dosen\Proyek;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Iklan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\RedirectResponse;

class IklanController extends Controller
{
    /**
     * Show the form for creating a new project.
     */
    public function create(): View
    {
        return view('dosen.proyek.iklan');
    }

    /**
     * Store a newly created project.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'gambar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:4096'],
        ]);

        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('uploads/iklan', 'public');
        }

        Iklan::create([
            'gambar' => $gambarPath,
            'dosen_id' => Auth::id(),
        ]);

        return redirect()->route('dosen.iklan')
            ->with('success', 'Iklan berhasil ditambahkan.');
    }

    /**
     * Delete project and its associated data
     */
    public function destroy(Iklan $iklan): RedirectResponse
    {
        // Delete sampul if exists
        if ($iklan->gambar) {
            Storage::disk('public')->delete($iklan->gambar);
        }

        // Delete project and its related kegiatan (will be handled by cascade)
        $iklan->delete();

        return redirect()->route('dosen.buatproyek')
            ->with('success', 'Iklan berhasil dihapus.');
    }
}