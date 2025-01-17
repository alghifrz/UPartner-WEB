<?php

namespace App\Http\Controllers;

use App\Models\Footer;
use App\Models\Kontak;
use App\Models\Privasi;
use App\Models\Tentang;
use App\Models\FooterDosen;
use App\Models\LandingPage;
use App\Models\NavbarLanding;

class LinkFooterController extends Controller
{

    public function about()
    {
        $header = 'Tentang Kami';
        $tentang = Tentang::getData(); 
        $footer = Footer::getData(); 
        return view('linkfooter.tentang', compact( 'header', 'tentang', 'footer'));
    }

    public function aboutDosen()
    {
        $header = 'Tentang Kami';
        $tentang = Tentang::getData(); 
        $footer = FooterDosen::getData(); 
        return view('dosen.linkfooter.tentang', compact( 'header', 'tentang', 'footer'));
    }

    public function contact()
    {
        $header = 'Hubungi Kami';
        $kontak = Kontak::getData();
        $footer = Footer::getData(); 
        return view('linkfooter.kontak', compact( 'header', 'kontak', 'footer'));
    }

    public function contactDosen()
    {
        $header = 'Hubungi Kami';
        $kontak = Kontak::getData();
        $footer = FooterDosen::getData(); 
        return view('dosen.linkfooter.kontak', compact( 'header', 'kontak', 'footer'));
    }

    public function privacy()
    {
        $header = 'Kebijakan Privasi';
        $privasi = Privasi::getData();
        $footer = Footer::getData(); 
        return view('linkfooter.privasi', compact( 'header', 'privasi', 'footer'));
    }

    public function privacyDosen()
    {
        $header = 'Kebijakan Privasi';
        $privasi = Privasi::getData();
        $footer = FooterDosen::getData(); 
        return view('dosen.linkfooter.privasi', compact( 'header', 'privasi', 'footer'));
    }
}


?>