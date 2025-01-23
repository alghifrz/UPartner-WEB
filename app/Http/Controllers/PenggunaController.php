<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Dosen;
use App\Models\Prodi;
use App\Models\Footer;
use App\Models\Kontak;
use App\Models\Privasi;
use App\Models\Tentang;
use App\Models\LandingPage;
use Illuminate\Http\Request;
use App\Models\FooterLanding;
use App\Models\NavbarLanding;

class PenggunaController extends Controller
{
    public function index(Request $request)
    {
        $query = collect();

        // Menentukan tabel berdasarkan filter
        if ($request->has('role') && $request->role == 'mahasiswa') {
            // Jika filter adalah mahasiswa
            $query = User::query();
        } elseif ($request->has('role') && $request->role == 'dosen') {
            // Jika filter adalah dosen
            $query = Dosen::query();
        } else {
            $query = User::query()->union(Dosen::query());
        }

        // Filter berdasarkan program studi
        if ($request->has('prodi') && $request->prodi != '') {
            $query->where('prodi', $request->prodi);
        }

        // Filter berdasarkan pencarian nama
        if ($request->has('search') && $request->search != '') {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', "%{$searchTerm}%");
            });
        }

        // Sorting berdasarkan UPoint atau Nama
        if ($request->has('sort')) {
            if ($request->sort == 'upoint') {
                $query->orderBy('upoint', 'desc');
            } elseif ($request->sort == 'name') {
                $query->orderBy('name', 'asc');
            }
        }

        

        // Mengambil data user dengan pagination
        $users = $query->paginate(10); // Ganti 10 dengan jumlah halaman yang diinginkan
        $programStudi = Prodi::all(); // Ambil program studi yang unik dari mahasiswa
        $footer = Footer::getData();
        return view('pengguna', compact('users', 'programStudi', 'footer'));
    }

}


?>