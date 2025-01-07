<?php

namespace App\Http\Controllers;

use App\Models\Iklan;
use App\Models\Footer;
use App\Models\Proyek;
use App\Models\Dashboard;

class DashboardController extends Controller
{
    public function index()
    {
        $dashboard = Dashboard::getData();
        $iklan = Iklan::latest('id')->get();
        $proyek = Proyek::latest('id')->get();
        $footer = Footer::getData(); 
        return view('dashboard', compact( 'dashboard', 'iklan', 'proyek', 'footer'));
    }

    public function indexDosen()
    {
        $dashboard = Dashboard::getData();
        $iklan = Iklan::latest('id')->get();
        $proyek = Proyek::latest('id')->get();
        $footer = Footer::getData(); 
        return view('dosen.dashboard', compact( 'dashboard', 'iklan', 'proyek', 'footer'));
    }

}


?>