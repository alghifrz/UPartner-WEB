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
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {   
        $dashboard = Dashboard::getData();
        $iklan = Iklan::latest('id')->get();

        Proyek::where('tanggal_mulai', '>', now())->update(['status_proyek' => 'belum dimulai']);
        Proyek::where('tanggal_selesai', '<', now())->update(['status_proyek' => 'selesai']);
        Proyek::where('tanggal_mulai', '<=', now())
              ->where('tanggal_selesai', '>=', now())
              ->update(['status_proyek' => 'sedang berlangsung']);
    
        $proyek = Proyek::latest('id')->take(8)->get();
        $footer = Footer::getData(); 
        return view('dashboard', compact( 'dashboard', 'iklan', 'proyek', 'footer'));
    }

    public function indexDosen()
    {

        $dashboard = Dashboard::getData();
        $iklan = Iklan::latest('id')->get();

        Proyek::where('tanggal_mulai', '>', now())->update(['status_proyek' => 'belum dimulai']);
        Proyek::where('tanggal_selesai', '<', now())->update(['status_proyek' => 'selesai']);
        Proyek::where('tanggal_mulai', '<=', now())
              ->where('tanggal_selesai', '>=', now())
              ->update(['status_proyek' => 'sedang berlangsung']);
        
              $proyek = Proyek::latest('id')->take(8)->get();
        $footer = FooterDosen::getData(); 
        return view('dosen.dashboard', compact( 'dashboard', 'iklan', 'proyek', 'footer'));
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