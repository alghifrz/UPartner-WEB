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
        $request->validate([
            'alasan_mendaftar' => 'required|string',
            'persyaratan_kemampuan' => 'required|string',
            'role' => 'required|string',
        ]);

        $user = Auth::user();
        $id_user = $user->id;

        $id_mahasiswa = $user->nim ? $id_user : null; 
        $id_dosen = $user->nip ? $id_user : null;
    
        // Logic untuk menyimpan data pendaftaran
        Pendaftaran::create([
            'id_proyek' => $proyek->id,
            'id_mahasiswa' => $id_mahasiswa,
            'id_dosen' => $id_dosen,
            'alasan_mendaftar' => $request->alasan_mendaftar,
            'persyaratan_kemampuan' => $request->persyaratan_kemampuan,
            'role' => $request->role,
            'status' => 'Menunggu',
        ]);
    
        return redirect()->back()->with('success', 'Pendaftaran berhasil!');
    }
    



    public function ubahStatus(Request $request, Pendaftaran $pendaftaran)
    {
        $request->validate([
            'status' => 'required|in:Menunggu,Diterima,Ditolak',
        ]);

        $pendaftaran->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Status pendaftaran berhasil diperbarui!');
    }
}
