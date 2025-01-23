<?php
// File: app/Http/Controllers/Dosen/Proyek/ProjectController.php

namespace App\Http\Controllers\Dosen\Proyek;

use App\Models\Prodi;
use App\Models\Footer;
use App\Models\Proyek;
use App\Models\Katalog;
use App\Models\Kegiatan;
use Illuminate\View\View;
use App\Models\FooterDosen;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\FooterLanding;
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
        $footer = FooterDosen::getData();
        return view('dosen.proyek.buatproyek', compact('footer'));
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
            // 'tanggal_selesai' => ['required', 'date', 'after_or_equal:tanggal_mulai'],
            'tanggal_selesai' => ['required', 'date'],
            'persyaratan' => ['required', 'array'],
            'persyaratan.*.nama' => ['required', 'string'],
            'role' => ['required', 'array'],
            'role.*.nama' => ['required', 'string'],
            'kegiatan' => ['nullable', 'array'],
            'kegiatan.*.nama' => ['required_with:kegiatan', 'string'],
            // 'kegiatan.*.tanggal_mulai' => ['required_with:kegiatan', 'date', 'after_or_equal:tanggal_mulai', 'before_or_equal:tanggal_selesai'],
            'kegiatan.*.tanggal_mulai' => ['required_with:kegiatan', 'date'],
            // 'kegiatan.*.tanggal_selesai' => ['required_with:kegiatan', 'date', 'after_or_equal:kegiatan.*.tanggal_mulai', 'before_or_equal:tanggal_selesai'],
            'kegiatan.*.tanggal_selesai' => ['required_with:kegiatan', 'date'],
            'sampul' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

            // Validasi tambahan untuk error spesifik
    $errors = [];

    if (empty($validated['judul_proyek'])) {
        $errors[] = 'Judul proyek tidak boleh kosong.';
    }
        
    if (empty($validated['deskripsi_proyek'])) {
        $errors[] = 'Deskripsi proyek tidak boleh kosong.';
    }

    if (empty($validated['tanggal_mulai'])) {
        $errors[] = 'Tanggal mulai proyek tidak boleh kosong.';
    }

    if (empty($validated['tanggal_selesai'])) {
        $errors[] = 'Tanggal selesai proyek tidak boleh kosong.';
    }

    if (empty($validated['persyaratan'])) {
        $errors[] = 'Persyaratan proyek tidak boleh kosong.';
    }

    if (empty($validated['role'])) {
        $errors[] = 'Role proyek tidak boleh kosong.';
    }

    if ($request->hasFile('sampul')) {
        // Cek apakah file yang di-upload adalah gambar
        $file = $request->file('sampul');
        
        // Cek apakah file merupakan gambar (image)
        if (!$file->isValid() || !in_array($file->getMimeType(), ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'])) {
            $errors[] = 'File sampul harus berupa gambar dengan format jpeg, png, jpg, atau gif.';
        }
    
        // Cek ukuran file (max 2048 KB = 2 MB)
        if ($file->getSize() > 2048 * 1024) {
            $errors[] = 'Ukuran file sampul tidak boleh lebih dari 2MB.';
        }
    } else {
        // Tidak ada file yang di-upload, periksa apakah file tersebut diharapkan
        $errors[] = 'Sampul proyek tidak boleh kosong jika di-upload.';
    }
    

    // 1. Cek apakah tanggal selesai proyek lebih dulu dari tanggal mulai proyek
    if (strtotime($validated['tanggal_selesai']) < strtotime($validated['tanggal_mulai'])) {
        $errors[] = 'Tanggal selesai proyek tidak boleh lebih awal dari tanggal mulai proyek.';
    }

    // 2. Cek apakah tanggal selesai kegiatan lebih dulu dari tanggal mulai kegiatan
    if (isset($validated['kegiatan'])) {
        foreach ($validated['kegiatan'] as $index => $kegiatanData) {
            if (strtotime($kegiatanData['tanggal_selesai']) < strtotime($kegiatanData['tanggal_mulai'])) {
                $errors[] = 'Tanggal selesai kegiatan "' . $kegiatanData['nama'] . '" tidak boleh lebih awal dari tanggal mulai kegiatan.';
            }
        }
    }

    // 3. Cek apakah tanggal kegiatan di luar rentang tanggal mulai dan selesai proyek
    if (isset($validated['kegiatan'])) {
        foreach ($validated['kegiatan'] as $index => $kegiatanData) {
            if (strtotime($kegiatanData['tanggal_mulai']) < strtotime($validated['tanggal_mulai']) || strtotime($kegiatanData['tanggal_selesai']) > strtotime($validated['tanggal_selesai'])) {
                $errors[] = 'Tanggal kegiatan "' . $kegiatanData['nama'] . '" tidak boleh berada di luar rentang tanggal proyek.';
            }
        }
    }

    // Jika ada error, simpan di session dan redirect kembali
    if (!empty($errors)) {
        return redirect()->route('dosen.buatproyek')
            ->withErrors($errors); // Kirimkan pesan error ke session
    }
 
        // Handle sampul upload
        $sampulPath = null;
        if ($request->hasFile('sampul')) {
            $sampulPath = $request->file('sampul')->store('uploads/sampul', 'public');
        }

        $status = 'belum dimulai'; // Default status jika belum ada kecocokan

        $tanggalMulai = strtotime($validated['tanggal_mulai']);
        $tanggalSelesai = strtotime($validated['tanggal_selesai']);
        $tanggalSekarang = strtotime(now()); // Ini untuk membandingkan dengan waktu saat ini jika perlu
        
        // Jika tanggal mulai kurang dari atau sama dengan waktu sekarang, dan tanggal selesai lebih dari atau sama dengan waktu sekarang
        if ($tanggalMulai <= $tanggalSekarang && $tanggalSelesai >= $tanggalSekarang) {
            $status = 'sedang berlangsung';
        } 
        // Jika tanggal selesai lebih kecil dari waktu sekarang
        elseif ($tanggalSelesai < $tanggalSekarang) {
            $status = 'selesai';
        }

        // Create proyek
        $proyek = Proyek::create([
            'judul_proyek' => $validated['judul_proyek'],
            'deskripsi_proyek' => $validated['deskripsi_proyek'],
            'tanggal_mulai' => $validated['tanggal_mulai'],
            'tanggal_selesai' => $validated['tanggal_selesai'],
            'status_proyek' => $status,
            'persyaratan_kemampuan' => $validated['persyaratan'],
            'role' => $validated['role'],
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

    public function searchGuest(Request $request): View
    {
        $programStudi = Prodi::all();
        $footer = FooterLanding::getData();
        $katalog = Katalog::getData();
        // Ambil kata kunci pencarian dari request
        $keyword = $request->input('keyword');

        if (empty($keyword)) {
            $proyek = Proyek::latest('id')->paginate(12);
            return view('katalog', compact('programStudi', 'katalog', 'proyek', 'footer'));
        }

        // Cari proyek berdasarkan judul atau deskripsi
        $proyek = Proyek::query()
            ->where('judul_proyek', 'like', "%{$keyword}%")
            ->orWhere('deskripsi_proyek', 'like', "%{$keyword}%")
            ->orWhereHas('proyekManajer', function($query) use ($keyword) {
                $query->where('name', 'like', "%{$keyword}%");
            })
            ->paginate(12);

        // Tampilkan hasil pencarian ke tampilan
        return view('katalogguest', compact('programStudi', 'katalog', 'proyek', 'footer'));
    }

    public function search(Request $request): View
    {
        $programStudi = Prodi::all();
        $footer = Footer::getData();
        $katalog = Katalog::getData();
        // Ambil kata kunci pencarian dari request
        $keyword = $request->input('keyword');

        if (empty($keyword)) {
            $proyek = Proyek::latest('id')->paginate(12);
            return view('katalog', compact('programStudi', 'katalog', 'proyek', 'footer'));
        }

        // Cari proyek berdasarkan judul atau deskripsi
        $proyek = Proyek::query()
            ->where('judul_proyek', 'like', "%{$keyword}%")
            ->orWhere('deskripsi_proyek', 'like', "%{$keyword}%")
            ->orWhereHas('proyekManajer', function($query) use ($keyword) {
                $query->where('name', 'like', "%{$keyword}%");
            })
            ->paginate(12);

        // Tampilkan hasil pencarian ke tampilan
        return view('katalog', compact('programStudi', 'katalog', 'proyek', 'footer'));
    }

    public function searchDosen(Request $request): View
    {
        $programStudi = Prodi::all();
        $footer = FooterDosen::getData();
        $katalog = Katalog::getData();
        // Ambil kata kunci pencarian dari request
        $keyword = $request->input('keyword');

        if (empty($keyword)) {
            $proyek = Proyek::latest('id')->paginate(12);
            return view('dosen.katalog', compact('programStudi', 'katalog', 'proyek', 'footer'));
        }

        // Cari proyek berdasarkan judul atau deskripsi
        $proyek = Proyek::query()
            ->where('judul_proyek', 'like', "%{$keyword}%")
            ->orWhere('deskripsi_proyek', 'like', "%{$keyword}%")
            ->orWhereHas('proyekManajer', function($query) use ($keyword) {
                $query->where('name', 'like', "%{$keyword}%");
            })
            ->paginate(12);

        // Tampilkan hasil pencarian ke tampilan
        return view('dosen.katalog', compact('programStudi', 'katalog', 'proyek', 'footer'));
    }


    public function detailGuest(Proyek $proyek)
    {   
        $footer = FooterLanding::getData();
        return view('detailproyekguest', compact('proyek', 'footer'));
    }

    public function detail(Proyek $proyek)
    {   
        $user = Auth::user();
        $rekomendasi = Proyek::latest('id')
            ->whereHas('proyekManajer', function ($query) {
                $query->where('prodi_id', Auth::user()->prodi_id);
            })
            ->take(4)
            ->get();
        $footer = Footer::getData();
        return view('proyek.detailproyek', compact('user', 'proyek', 'rekomendasi', 'footer'));
    }

    public function detailDosen(Proyek $proyek)
    {   
        $user = Auth::user();
        $rekomendasi = Proyek::latest('id')
            ->whereHas('proyekManajer', function ($query) {
                $query->where('prodi_id', Auth::user()->prodi_id);
            })
            ->take(4)
            ->get();
        $footer = FooterDosen::getData();
        return view('dosen.proyek.detailproyek', compact('user', 'proyek', 'rekomendasi', 'footer'));
    }

    public function edit(Proyek $proyek)
    {
        $user = Auth::user();
        $footer = FooterDosen::getData();
        return view('dosen.proyek.editproyek', compact('user', 'footer', 'proyek'));
    }

    public function update(Request $request, Proyek $proyek): RedirectResponse
    {
        // Validate request
        $validated = $request->validate([
            'judul_proyek' => ['required', 'string'],
            'deskripsi_proyek' => ['required', 'string', 'max:4096'],
            'tanggal_mulai' => ['required', 'date'],
            'tanggal_selesai' => ['required', 'date'],
            'persyaratan' => ['required', 'array'],
            'persyaratan.*.nama' => ['required', 'string'],
            'role' => ['required', 'array'],
            'role.*.nama' => ['required', 'string'],
            'kegiatan' => ['nullable', 'array'],
            'kegiatan.*.nama' => ['required_with:kegiatan', 'string'],
            'kegiatan.*.tanggal_mulai' => ['required_with:kegiatan', 'date'],
            'kegiatan.*.tanggal_selesai' => ['required_with:kegiatan', 'date'],
            'sampul' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        // Validasi tambahan untuk error spesifik
        $errors = [];

        if (empty($validated['judul_proyek'])) {
            $errors[] = 'Judul proyek tidak boleh kosong.';
        }
        
        if (empty($validated['deskripsi_proyek'])) {
            $errors[] = 'Deskripsi proyek tidak boleh kosong.';
        }

        if (empty($validated['tanggal_mulai'])) {
            $errors[] = 'Tanggal mulai proyek tidak boleh kosong.';
        }

        if (empty($validated['tanggal_selesai'])) {
            $errors[] = 'Tanggal selesai proyek tidak boleh kosong.';
        }

        if (empty($validated['persyaratan'])) {
            $errors[] = 'Persyaratan proyek tidak boleh kosong.';
        }

        if (empty($validated['role'])) {
            $errors[] = 'Role proyek tidak boleh kosong.';
        }

        if ($request->hasFile('sampul')) {
            $file = $request->file('sampul');
            
            if (!$file->isValid() || !in_array($file->getMimeType(), ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'])) {
                $errors[] = 'File sampul harus berupa gambar dengan format jpeg, png, jpg, atau gif.';
            }
        
            if ($file->getSize() > 2048 * 1024) {
                $errors[] = 'Ukuran file sampul tidak boleh lebih dari 2MB.';
            }
        }

        // 1. Cek apakah tanggal selesai proyek lebih dulu dari tanggal mulai proyek
        if (strtotime($validated['tanggal_selesai']) < strtotime($validated['tanggal_mulai'])) {
            $errors[] = 'Tanggal selesai proyek tidak boleh lebih awal dari tanggal mulai proyek.';
        }

        // 2. Cek apakah tanggal selesai kegiatan lebih dulu dari tanggal mulai kegiatan
        if (isset($validated['kegiatan'])) {
            foreach ($validated['kegiatan'] as $index => $kegiatanData) {
                if (strtotime($kegiatanData['tanggal_selesai']) < strtotime($kegiatanData['tanggal_mulai'])) {
                    $errors[] = 'Tanggal selesai kegiatan "' . $kegiatanData['nama'] . '" tidak boleh lebih awal dari tanggal mulai kegiatan.';
                }
            }
        }

        // 3. Cek apakah tanggal kegiatan di luar rentang tanggal mulai dan selesai proyek
        if (isset($validated['kegiatan'])) {
            foreach ($validated['kegiatan'] as $index => $kegiatanData) {
                if (strtotime($kegiatanData['tanggal_mulai']) < strtotime($validated['tanggal_mulai']) || 
                    strtotime($kegiatanData['tanggal_selesai']) > strtotime($validated['tanggal_selesai'])) {
                    $errors[] = 'Tanggal kegiatan "' . $kegiatanData['nama'] . '" tidak boleh berada di luar rentang tanggal proyek.';
                }
            }
        }

        // Jika ada error, simpan di session dan redirect kembali
        if (!empty($errors)) {
            return redirect()->route('dosen.editproyek', $proyek->id)
                ->withErrors($errors);
        }

        // Handle sampul upload
        if ($request->hasFile('sampul')) {
            // Delete old sampul if exists
            if ($proyek->sampul && Storage::disk('public')->exists($proyek->sampul)) {
                Storage::disk('public')->delete($proyek->sampul);
            }
            $sampulPath = $request->file('sampul')->store('uploads/sampul', 'public');
            $validated['sampul'] = $sampulPath;
        }

        // Update status proyek
        $tanggalMulai = strtotime($validated['tanggal_mulai']);
        $tanggalSelesai = strtotime($validated['tanggal_selesai']);
        $tanggalSekarang = strtotime(now());
        
        if ($tanggalMulai <= $tanggalSekarang && $tanggalSelesai >= $tanggalSekarang) {
            $status = 'sedang berlangsung';
        } elseif ($tanggalSelesai < $tanggalSekarang) {
            $status = 'selesai';
        } else {
            $status = 'belum dimulai';
        }

        // Update proyek
        $proyek->update([
            'judul_proyek' => $validated['judul_proyek'],
            'deskripsi_proyek' => $validated['deskripsi_proyek'],
            'tanggal_mulai' => $validated['tanggal_mulai'],
            'tanggal_selesai' => $validated['tanggal_selesai'],
            'status_proyek' => $status,
            'persyaratan_kemampuan' => $validated['persyaratan'],
            'role' => $validated['role'],
            'sampul' => $validated['sampul'] ?? $proyek->sampul,
        ]);

        // Update Kegiatan
        if (isset($validated['kegiatan'])) {
            // Delete existing kegiatan
            $proyek->kegiatan()->delete();
            
            // Create new kegiatan
            foreach ($validated['kegiatan'] as $kegiatanData) {
                $proyek->kegiatan()->create([
                    'nama' => $kegiatanData['nama'],
                    'tanggal_mulai' => $kegiatanData['tanggal_mulai'],
                    'tanggal_selesai' => $kegiatanData['tanggal_selesai'],
                ]);
            }
        }

        return redirect()->route('dosen.editproyek', $proyek->id)
            ->with('success', 'Proyek berhasil diperbarui.');
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

        return redirect()->route('dosen.kelolaproyek')->with('success', 'Proyek berhasil dihapus.');
    }
}