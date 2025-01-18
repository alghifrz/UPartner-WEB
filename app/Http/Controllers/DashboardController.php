<?php

namespace App\Http\Controllers;

use App\Models\Iklan;
use App\Models\Footer;
use App\Models\Proyek;
use App\Models\Dashboard;
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

}


?>