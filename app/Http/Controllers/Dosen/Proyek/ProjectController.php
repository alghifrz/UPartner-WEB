<?php
// File: app/Http/Controllers/Dosen/Proyek/ProjectController.php

namespace App\Http\Controllers\Dosen\Proyek;

use App\Models\Footer;
use App\Models\Proyek;
use App\Models\Kegiatan;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Show the form for creating a new project.
     */
    public function create(): View
    {
        return view('dosen.proyek.buatproyek');
    }

    /**
     * Store a newly created project.
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate request
        $validated = $request->validate([
            'judul_proyek' => ['required', 'string'],
            'deskripsi_proyek' => ['required', 'string', 'max:4096'],
            'tanggal_mulai' => ['required', 'date'],
            'tanggal_selesai' => ['required', 'date', 'after_or_equal:tanggal_mulai'],
            'persyaratan' => ['required', 'array'],
            'persyaratan.*.nama' => ['required', 'string'],
            'spesifikasi' => ['required', 'array'],
            'spesifikasi.*.nama' => ['required', 'string'],
            'kegiatan' => ['nullable', 'array'],
            'kegiatan.*.nama' => ['required_with:kegiatan', 'string'],
            'kegiatan.*.tanggal_mulai' => ['required_with:kegiatan', 'date'],
            'kegiatan.*.tanggal_selesai' => ['required_with:kegiatan', 'date', 'after_or_equal:kegiatan.*.tanggal_mulai'],
            'sampul' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        // Handle sampul upload
        $sampulPath = null;
        if ($request->hasFile('sampul')) {
            $sampulPath = $request->file('sampul')->store('uploads/sampul', 'public');
        }

        // Create proyek
        $proyek = Proyek::create([
            'judul_proyek' => $validated['judul_proyek'],
            'deskripsi_proyek' => $validated['deskripsi_proyek'],
            'tanggal_mulai' => $validated['tanggal_mulai'],
            'tanggal_selesai' => $validated['tanggal_selesai'],
            'status_proyek' => 'belum dimulai',
            'persyaratan_kemampuan' => $validated['persyaratan'],
            'spesifikasi_perangkat' => $validated['spesifikasi'],
            'sampul' => $sampulPath,
            'proyek_manajer_id' => Auth::id(),
        ]);

        // Store Kegiatan
        if (isset($validated['kegiatan'])) {
            foreach ($validated['kegiatan'] as $kegiatanData) {
                $proyek->kegiatan()->create([
                    'nama' => $kegiatanData['nama'],
                    'tanggal_mulai' => $kegiatanData['tanggal_mulai'],
                    'tanggal_selesai' => $kegiatanData['tanggal_selesai'],
                ]);
            }
        }

        return redirect()->route('dosen.buatproyek')
            ->with('success', 'Proyek berhasil dibuat.');
    }

    public function detail(Proyek $proyek)
    {   
        $footer = Footer::getData();
        return view('proyek.detailproyek', compact('proyek', 'footer'));
    }

    public function detailDosen(Proyek $proyek)
    {   
        $footer = Footer::getData();
        return view('dosen.proyek.detailproyek', compact('proyek', 'footer'));
    }


    /**
     * Delete project and its associated data
     */
    public function destroy(Proyek $proyek): RedirectResponse
    {
        // Delete sampul if exists
        if ($proyek->sampul) {
            Storage::disk('public')->delete($proyek->sampul);
        }

        // Delete project and its related kegiatan (will be handled by cascade)
        $proyek->delete();

        return redirect()->route('dosen.buatproyek')
            ->with('success', 'Proyek berhasil dihapus.');
    }
}