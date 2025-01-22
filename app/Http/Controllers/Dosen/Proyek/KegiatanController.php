<?php
// File: app/Http/Controllers/Proyek/KegiatanController.php

namespace App\Http\Controllers\Dosen\Proyek;

use App\Models\Kegiatan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class KegiatanController extends Controller
{
    /**
     * Store a new Kegiatan for a Proyek.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'proyek_id' => ['required', 'exists:proyek,id'],
            'nama' => ['required', 'string'],
            'tanggal_mulai' => ['required', 'date'],
            'tanggal_selesai' => ['required', 'date', 'after_or_equal:tanggal_mulai'],
        ]);
        $validated['is_selesai'] = false;

        Kegiatan::create($validated);

        return redirect()->route('dosen.dashboard')
            ->with('success', 'Kegiatan berhasil ditambahkan.');
    }

    /**
     * Update the specified Kegiatan.
     */
    public function update(Request $request, Kegiatan $kegiatan): RedirectResponse
    {
        $validated = $request->validate([
            'nama' => ['required', 'string'],
            'tanggal_mulai' => ['required', 'date'],
            'tanggal_selesai' => ['required', 'date', 'after_or_equal:tanggal_mulai'],
        ]);

        $kegiatan->update($validated);

        return redirect()->route('dosen.proyek.index')
            ->with('success', 'Kegiatan berhasil diperbarui.');
    }

    public function updateProgres(Request $request, $proyekId, $kegiatanId)
    {
        // Cari kegiatan berdasarkan ID proyek dan ID kegiatan
        $kegiatan = Kegiatan::where('proyek_id', $proyekId)->findOrFail($kegiatanId);
    
        // Toggle status `is_selesai`
        $kegiatan->is_selesai = !$kegiatan->is_selesai;
        $kegiatan->save();
    
        // Redirect ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Progres kegiatan berhasil diperbarui!');
    }
    
    

    /**
     * Remove the specified Kegiatan.
     */
    public function destroy(Kegiatan $kegiatan): RedirectResponse
    {
        $kegiatan->delete();

        return redirect()->route('dosen.proyek.index')
            ->with('success', 'Kegiatan berhasil dihapus.');
    }
}


?>