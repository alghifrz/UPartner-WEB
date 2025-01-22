<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Proyek;
use App\Models\Mahasiswa;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PendaftaranController extends Controller
{
    public function daftar(Request $request, Proyek $proyek)
    {
        // Validasi input
        $request->validate([
            'alasan_mendaftar' => 'required|string',
            'persyaratan_kemampuan' => 'required|array',  // Ubah validasi menjadi array
            'role' => 'required|string',
        ]);
    
        // Ambil data pengguna
        $user = Auth::user();
    
        // Tentukan apakah pengguna adalah mahasiswa atau dosen
        $id_mahasiswa = $user->nim ? $user->id : null;
        $id_dosen = $user->nip ? $user->id : null;
        $persyaratanKemampuan = json_encode($request->persyaratan_kemampuan);
        // Simpan data pendaftaran
        Pendaftaran::create([
            'id_proyek' => $proyek->id,
            'id_mahasiswa' => $id_mahasiswa,
            'id_dosen' => $id_dosen,
            'alasan_mendaftar' => $request->alasan_mendaftar,
            'persyaratan_kemampuan' => $persyaratanKemampuan,
            'role' => $request->role,
            'status' => 'Menunggu',
        ]);
    
        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Silahkan menunggu pemberitahuan selanjutnya. Pantau terus status pendaftaranmu!');
    }
        
    public function ubahStatus(Request $request, Pendaftaran $pendaftaran)
    {
        $request->validate([
            'status' => 'required|in:Menunggu,Diterima,Ditolak',
        ]);

        $pendaftaran->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Status pendaftaran berhasil diperbarui!');
    }

    public function terimaPendaftar($proyekId, $pendaftarId)
    {
        $pendaftar = Pendaftaran::where('id', $pendaftarId)->where('id_proyek', $proyekId)->firstOrFail();
        $pendaftar->status = 'diterima'; 
        $pendaftar->save();

        return redirect()->back()->with('success', 'Pendaftar berhasil diterima.');
    }

    public function tolakPendaftar($proyekId, $pendaftarId)
    {
        $pendaftar = Pendaftaran::where('id', $pendaftarId)->where('id_proyek', $proyekId)->firstOrFail();
        $pendaftar->status = 'ditolak'; // Update status
        $pendaftar->save();

        return redirect()->back()->with('success', 'Pendaftar berhasil ditolak.');
    }

    public function keluarkanAnggota($proyekId, $pendaftarId)
    {
        $pendaftar = Pendaftaran::where('id', $pendaftarId)->where('id_proyek', $proyekId)->firstOrFail();
        
        $pendaftar->delete();

        return redirect()->back()->with('success', 'Anggota Tim Berhasil Dikeluarkan.');
    }

}
