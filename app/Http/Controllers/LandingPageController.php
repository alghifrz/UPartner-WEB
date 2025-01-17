<?php

namespace App\Http\Controllers;

use App\Models\Kontak;
use App\Models\Privasi;
use App\Models\Tentang;
use App\Models\LandingPage;
use App\Models\FooterLanding;
use App\Models\NavbarLanding;

class LandingPageController extends Controller
{
    public function index()
    {

        $navbarlanding = NavbarLanding::getData(); 
        $header = 'UPartner';
        $landingpage = LandingPage::getData(); 
        $footer = FooterLanding::getData(); 
        return view('landingpage', compact( 'navbarlanding', 'header', 'landingpage', 'footer'));
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
        return view('kebijakan-privasi', compact( 'navbarlanding', 'header', 'privasi', 'footer'));
    }
}


?>