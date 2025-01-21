<?php
// File: app/Http/Controllers/Dosen/Proyek/ProjectController.php

namespace App\Http\Controllers\Dosen\Proyek;

use App\Models\Iklan;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

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
            ->with('success', 'Iklan Berhasil Dibuat.');
    }

    public function update(Request $request)
    {
        $request->validate([
            'gambar' => 'required|image|mimes:jpg,jpeg,png|max:2048', // Validasi gambar
        ]);
    
        $iklan = Iklan::findOrFail($request->id); // Menemukan iklan berdasarkan ID
    
        // Cek jika gambar baru diupload
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if (File::exists(public_path($iklan->gambar))) {
                File::delete(public_path($iklan->gambar));
            }
    
            // Simpan gambar baru
            $imagePath = $request->file('gambar')->store('iklan', 'public'); // Menyimpan file ke direktori iklan
            $iklan->gambar = $imagePath; // Update path gambar di database
        }
    
        $iklan->save(); // Simpan perubahan
    
        return back()->with('success', 'Iklan Berhasil Diupdate');
    }
    
    /**
     * Delete project and its associated data
     */
    public function delete($id)
    {
        $iklan = Iklan::findOrFail($id);
    
        // Hapus file gambar dari penyimpanan
        if (File::exists(public_path($iklan->gambar))) {
            File::delete(public_path($iklan->gambar));
        }
    
        $iklan->delete();  // Hapus data iklan
    
        return back()->with('success', 'Iklan berhasil dihapus');
    }
    
}