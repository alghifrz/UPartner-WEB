<?php

namespace App\Http\Controllers;

use App\Models\Kontak;
use App\Models\Privasi;
use App\Models\Tentang;
use App\Models\LandingPage;
use App\Models\FooterLanding;
use App\Models\NavbarLanding;
use App\Models\User;

class LandingPageController extends Controller
{
    public function index()
    {
        $topStudents = User::withCount(['pendaftaran' => function ($query) {
                            $query->where('status', 'Diterima');
                        }])
                        ->orderBy('pendaftaran_count', 'desc') // Urutkan berdasarkan jumlah pendaftaran
                        ->take(3) // Ambil hanya 3 user teratas
                        ->get();
        $navbarlanding = NavbarLanding::getData(); 
        $header = 'UPartner';
        $landingpage = LandingPage::getData(); 
        $footer = FooterLanding::getData(); 
        return view('landingpage', compact( 'topStudents', 'navbarlanding', 'header', 'landingpage', 'footer'));
    }

    public function about()
    {
        $navbarlanding = NavbarLanding::getData(); 
        $header = 'Tentang Kami';
        $tentang = Tentang::getData(); 
        $footer = FooterLanding::getData(); 
        return view('tentang', compact( 'navbarlanding', 'header', 'tentang', 'footer'));
    }

    public function contact()
    {
        $navbarlanding = NavbarLanding::getData(); 
        $header = 'Hubungi Kami';
        $kontak = Kontak::getData();
        $footer = FooterLanding::getData(); 
        return view('kontak', compact( 'navbarlanding', 'header', 'kontak', 'footer'));
    }

    public function privacy()
    {
        $navbarlanding = NavbarLanding::getData(); 
        $header = 'Kebijakan Privasi';
        $privasi = Privasi::getData();
        $footer = FooterLanding::getData(); 
        return view('privasi', compact( 'navbarlanding', 'header', 'privasi', 'footer'));
    }
}


?>