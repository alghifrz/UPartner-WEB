<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use App\Models\Footer;
use App\Models\Proyek;
use App\Models\Katalog;
use App\Models\FooterDosen;
use App\Models\FooterLanding;
use Illuminate\Http\Request;

class KatalogController extends Controller
{
    public function indexGuest(Request $request)
    {
        $programStudi = Prodi::all();
        $prodi = $request->input('program_studi');  // Menangkap input program_studi yang berupa array
        $katalog = Katalog::getData();

        // Filter proyek berdasarkan program studi yang dipilih
        $proyek = Proyek::when($prodi, function ($query, $prodi) {
            return $query->whereHas('proyekManajer.prodi', function ($q) use ($prodi) {
                // Jika ada banyak prodi yang dipilih, gunakan whereIn
                return $q->whereIn('prodi_name', $prodi); 
            });
        })
        ->latest('id')
        ->paginate(12);

        $footer = FooterLanding::getData();
        return view('katalogguest', compact('programStudi', 'katalog', 'proyek', 'footer'));
    }
    
    public function index(Request $request)
    {
        $programStudi = Prodi::all();
        $prodi = $request->input('program_studi');  // Menangkap input program_studi yang berupa array
        $katalog = Katalog::getData();

        // Filter proyek berdasarkan program studi yang dipilih
        $proyek = Proyek::when($prodi, function ($query, $prodi) {
            return $query->whereHas('proyekManajer.prodi', function ($q) use ($prodi) {
                // Jika ada banyak prodi yang dipilih, gunakan whereIn
                return $q->whereIn('prodi_name', $prodi); 
            });
        })
        ->latest('id')
        ->paginate(12);

        $footer = Footer::getData();
        return view('katalog', compact('programStudi', 'katalog', 'proyek', 'footer'));
    }

    public function indexDosen(Request $request)
    {
        $programStudi = Prodi::all();
        $prodi = $request->input('program_studi');  // Menangkap input program_studi yang berupa array
        $katalog = Katalog::getData();

        // Filter proyek berdasarkan program studi yang dipilih
        $proyek = Proyek::when($prodi, function ($query, $prodi) {
            return $query->whereHas('proyekManajer.prodi', function ($q) use ($prodi) {
                // Jika ada banyak prodi yang dipilih, gunakan whereIn
                return $q->whereIn('prodi_name', $prodi); 
            });
        })
        ->latest('id')
        ->paginate(12);

        $footer = FooterDosen::getData();
        return view('dosen.katalog', compact('programStudi', 'katalog', 'proyek', 'footer'));
    }






}


?>