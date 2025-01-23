<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Dosen;
use App\Models\Iklan;
use App\Models\Footer;
use App\Models\Proyek;
use App\Models\Dashboard;
use Illuminate\View\View;
use App\Models\FooterDosen;
use App\Models\FooterLanding;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function indexguest()
    {   
        $topStudents = User::withCount(['pendaftaran' => function ($query) {
                        $query->where('status', 'Diterima');
                    }])
                    ->orderBy('pendaftaran_count', 'desc') // Urutkan berdasarkan jumlah pendaftaran
                    ->take(3) // Ambil hanya 3 user teratas
                    ->get();
        $dashboard = Dashboard::getData();
        $iklan = Iklan::latest('id')->get();

        Proyek::where('tanggal_mulai', '>', now())->update(['status_proyek' => 'belum dimulai']);
        Proyek::where('tanggal_selesai', '<', now())->update(['status_proyek' => 'selesai']);
        Proyek::where('tanggal_mulai', '<=', now())
              ->where('tanggal_selesai', '>=', now())
              ->update(['status_proyek' => 'sedang berlangsung']);
    
        $proyek = Proyek::latest('id')->take(8)->get();
        $footer = FooterLanding::getData(); 
        return view('dashboardguest', compact('topStudents', 'dashboard', 'iklan', 'proyek', 'footer'));
    }

    public function index()
    {   
        $topStudents = User::withCount(['pendaftaran' => function ($query) {
                        $query->where('status', 'Diterima');
                    }])
                    ->orderBy('pendaftaran_count', 'desc') // Urutkan berdasarkan jumlah pendaftaran
                    ->take(3) // Ambil hanya 3 user teratas
                    ->get();
        $dashboard = Dashboard::getData();
        $iklan = Iklan::latest('id')->get();

        Proyek::where('tanggal_mulai', '>', now())->update(['status_proyek' => 'belum dimulai']);
        Proyek::where('tanggal_selesai', '<', now())->update(['status_proyek' => 'selesai']);
        Proyek::where('tanggal_mulai', '<=', now())
              ->where('tanggal_selesai', '>=', now())
              ->update(['status_proyek' => 'sedang berlangsung']);
    
        $proyek = Proyek::latest('id')->take(8)->get();
        $footer = Footer::getData(); 
        return view('dashboard', compact('topStudents', 'dashboard', 'iklan', 'proyek', 'footer'));
    }

    public function indexDosen()
    {
        $topStudents = User::withCount(['pendaftaran' => function ($query) {
                        $query->where('status', 'Diterima');
                    }])
                    ->orderBy('pendaftaran_count', 'desc') // Urutkan berdasarkan jumlah pendaftaran
                    ->take(3) // Ambil hanya 3 user teratas
                    ->get();
        $dashboard = Dashboard::getData();
        $iklan = Iklan::latest('id')->get();

        Proyek::where('tanggal_mulai', '>', now())->update(['status_proyek' => 'belum dimulai']);
        Proyek::where('tanggal_selesai', '<', now())->update(['status_proyek' => 'selesai']);
        Proyek::where('tanggal_mulai', '<=', now())
              ->where('tanggal_selesai', '>=', now())
              ->update(['status_proyek' => 'sedang berlangsung']);
        
              $proyek = Proyek::latest('id')->take(8)->get();
        $footer = FooterDosen::getData(); 
        return view('dosen.dashboard', compact('topStudents', 'dashboard', 'iklan', 'proyek', 'footer'));
    }

    public function lihatProfilGuest(User $mahasiswa): View
    {
        $footer = FooterLanding::getData();
        return view('lihatprofilguest', [
            'footer' => $footer,
            'user' => $mahasiswa,
        ]);
    }

    public function lihatProfilDosenGuest(Dosen $dosen): View
    {
        $footer = FooterLanding::getData();
        return view('lihatprofildosenguest', [
            'footer' => $footer,
            'user' => $dosen,
        ]);
    }

    public function lihatProfil(User $mahasiswa): View
    {
        $footer = Footer::getData();
        return view('lihatprofil', [
            'footer' => $footer,
            'user' => $mahasiswa,
        ]);
    }

    public function lihatProfilDosen(Dosen $dosen): View
    {
        $footer = Footer::getData();
        return view('lihatprofildosen', [
            'footer' => $footer,
            'user' => $dosen,
        ]);
    }

    public function dosenlihatProfil(User $mahasiswa): View
    {
        $footer = FooterDosen::getData();
        return view('dosen.lihatprofil', [
            'footer' => $footer,
            'user' => $mahasiswa,
        ]);
    }

    public function dosenlihatProfilDosen(Dosen $dosen): View
    {
        $footer = FooterDosen::getData();
        return view('dosen.lihatprofildosen', [
            'footer' => $footer,
            'user' => $dosen,
        ]);
    }

}


?>