<?php

namespace App\Http\Controllers;

use App\Models\Footer;
use App\Models\Dashboard;
use App\Models\Proyek;

class DashboardController extends Controller
{
    public function index()
    {
        $dashboard = Dashboard::getData();
        $proyek = Proyek::latest('id')->get();
        $footer = Footer::getData(); 
        return view('dashboard', compact( 'dashboard', 'proyek', 'footer'));
    }

    public function indexDosen()
    {
        $dashboard = Dashboard::getData();
        $proyek = Proyek::latest('id')->get();
        $footer = Footer::getData(); 
        return view('dosen.dashboard', compact( 'dashboard', 'proyek', 'footer'));
    }

}


?>