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
    public function indexGuest(Request $request)
    {
        $query = collect();

        if ($request->has('role') && $request->role == 'mahasiswa') {
            $query = User::query();
            if ($request->has('prodi') && $request->prodi != '') {
                $query->where('prodi_id', $request->prodi);
            }
            if ($request->has('search') && $request->search != '') {
                $searchTerm = $request->search;
                $query->where(function ($q) use ($searchTerm) {
                    $q->where('name', 'like', "%{$searchTerm}%");
                });
            }
            if ($request->has('sort')) {
                if ($request->sort == 'upoint') {
                    $query->withCount(['pendaftaran' => function($query) {
                        $query->where('status', 'Diterima');
                    }])->orderByRaw('pendaftaran_count DESC');
                } elseif ($request->sort == 'nameasc') {
                    $query->orderBy('name', 'asc');
                } elseif ($request->sort == 'namedsc') {
                    $query->orderBy('name', 'desc');
                }
            }
        } 
        
        
        elseif ($request->has('role') && $request->role == 'dosen') {
            $query = Dosen::query();
            if ($request->has('prodi') && $request->prodi != '') {
                $query->where('prodi_id', $request->prodi);
            }
            if ($request->has('search') && $request->search != '') {
                $searchTerm = $request->search;
                $query->where(function ($q) use ($searchTerm) {
                    $q->where('name', 'like', "%{$searchTerm}%");
                });
            }
            if ($request->has('sort')) {
                if ($request->sort == 'upoint') {
                    $query->withCount([
                        'pendaftaran' => function($query) {
                            $query->where('status', 'Diterima');
                        },
                        'proyekDikelola' 
                    ])
                    ->orderByRaw('pendaftaran_count + proyek_dikelola_count DESC');
                } elseif ($request->sort == 'nameasc') {
                    $query->orderBy('name', 'asc');
                } elseif ($request->sort == 'namedsc') {
                    $query->orderBy('name', 'desc');
                }
            }
        } 
        
        else {
            $usersQuery = User::query();
            $dosensQuery = Dosen::query();

            if ($request->has('prodi') && $request->prodi != '') {
                $usersQuery->where('prodi_id', $request->prodi);
                $dosensQuery->where('prodi_id', $request->prodi); 
            }
            if ($request->has('search') && $request->search != '') {
                $searchTerm = $request->search;
                $usersQuery->where(function ($q) use ($searchTerm) {
                    $q->where('name', 'like', "%{$searchTerm}%");
                });
                $dosensQuery->where(function ($q) use ($searchTerm) {
                    $q->where('name', 'like', "%{$searchTerm}%");
                });
            }

            $query = $dosensQuery->union($usersQuery);
            if ($request->has('sort')) {
                if ($request->sort == 'nameasc') {
                    $query->orderBy('name', 'asc');
                } elseif ($request->sort == 'namedsc') {
                    $query->orderBy('name', 'desc');
                } 
            }

        }
        $mahasiswa = User::all();
        $dosen = Dosen::all();
        $users = $query->paginate(10);
        $programStudi = Prodi::all(); 
        $footer = FooterLanding::getData();
        return view('penggunaguest', compact('mahasiswa', 'dosen', 'users', 'programStudi', 'footer'));
    }
    public function index(Request $request)
    {
        $query = collect();

        if ($request->has('role') && $request->role == 'mahasiswa') {
            $query = User::query();
            if ($request->has('prodi') && $request->prodi != '') {
                $query->where('prodi_id', $request->prodi);
            }
            if ($request->has('search') && $request->search != '') {
                $searchTerm = $request->search;
                $query->where(function ($q) use ($searchTerm) {
                    $q->where('name', 'like', "%{$searchTerm}%");
                });
            }
            if ($request->has('sort')) {
                if ($request->sort == 'upoint') {
                    $query->withCount(['pendaftaran' => function($query) {
                        $query->where('status', 'Diterima');
                    }])->orderByRaw('pendaftaran_count DESC');
                } elseif ($request->sort == 'nameasc') {
                    $query->orderBy('name', 'asc');
                } elseif ($request->sort == 'namedsc') {
                    $query->orderBy('name', 'desc');
                }
            }
        } 
        
        
        elseif ($request->has('role') && $request->role == 'dosen') {
            $query = Dosen::query();
            if ($request->has('prodi') && $request->prodi != '') {
                $query->where('prodi_id', $request->prodi);
            }
            if ($request->has('search') && $request->search != '') {
                $searchTerm = $request->search;
                $query->where(function ($q) use ($searchTerm) {
                    $q->where('name', 'like', "%{$searchTerm}%");
                });
            }
            if ($request->has('sort')) {
                if ($request->sort == 'upoint') {
                    $query->withCount([
                        'pendaftaran' => function($query) {
                            $query->where('status', 'Diterima');
                        },
                        'proyekDikelola' 
                    ])
                    ->orderByRaw('pendaftaran_count + proyek_dikelola_count DESC');
                } elseif ($request->sort == 'nameasc') {
                    $query->orderBy('name', 'asc');
                } elseif ($request->sort == 'namedsc') {
                    $query->orderBy('name', 'desc');
                }
            }
        } 
        
        else {
            $usersQuery = User::query();
            $dosensQuery = Dosen::query();

            if ($request->has('prodi') && $request->prodi != '') {
                $usersQuery->where('prodi_id', $request->prodi);
                $dosensQuery->where('prodi_id', $request->prodi); 
            }
            if ($request->has('search') && $request->search != '') {
                $searchTerm = $request->search;
                $usersQuery->where(function ($q) use ($searchTerm) {
                    $q->where('name', 'like', "%{$searchTerm}%");
                });
                $dosensQuery->where(function ($q) use ($searchTerm) {
                    $q->where('name', 'like', "%{$searchTerm}%");
                });
            }

            $query = $dosensQuery->union($usersQuery);
            if ($request->has('sort')) {
                if ($request->sort == 'nameasc') {
                    $query->orderBy('name', 'asc');
                } elseif ($request->sort == 'namedsc') {
                    $query->orderBy('name', 'desc');
                } 
            }

        }
        $mahasiswa = User::all();
        $dosen = Dosen::all();
        $users = $query->paginate(10);
        $programStudi = Prodi::all(); 
        $footer = Footer::getData();
        return view('pengguna', compact('mahasiswa', 'dosen', 'users', 'programStudi', 'footer'));
    }

    public function indexDosen(Request $request)
    {
        $query = collect();

        if ($request->has('role') && $request->role == 'mahasiswa') {
            $query = User::query();
            if ($request->has('prodi') && $request->prodi != '') {
                $query->where('prodi_id', $request->prodi);
            }
            if ($request->has('search') && $request->search != '') {
                $searchTerm = $request->search;
                $query->where(function ($q) use ($searchTerm) {
                    $q->where('name', 'like', "%{$searchTerm}%");
                });
            }
            if ($request->has('sort')) {
                if ($request->sort == 'upoint') {
                    $query->withCount(['pendaftaran' => function($query) {
                        $query->where('status', 'Diterima');
                    }])->orderByRaw('pendaftaran_count DESC');
                } elseif ($request->sort == 'nameasc') {
                    $query->orderBy('name', 'asc');
                } elseif ($request->sort == 'namedsc') {
                    $query->orderBy('name', 'desc');
                }
            }
        } 
        
        
        elseif ($request->has('role') && $request->role == 'dosen') {
            $query = Dosen::query();
            if ($request->has('prodi') && $request->prodi != '') {
                $query->where('prodi_id', $request->prodi);
            }
            if ($request->has('search') && $request->search != '') {
                $searchTerm = $request->search;
                $query->where(function ($q) use ($searchTerm) {
                    $q->where('name', 'like', "%{$searchTerm}%");
                });
            }
            if ($request->has('sort')) {
                if ($request->sort == 'upoint') {
                    $query->withCount([
                        'pendaftaran' => function($query) {
                            $query->where('status', 'Diterima');
                        },
                        'proyekDikelola' 
                    ])
                    ->orderByRaw('pendaftaran_count + proyek_dikelola_count DESC');
                } elseif ($request->sort == 'nameasc') {
                    $query->orderBy('name', 'asc');
                } elseif ($request->sort == 'namedsc') {
                    $query->orderBy('name', 'desc');
                }
            }
        } 
        
        else {
            $usersQuery = User::query();
            $dosensQuery = Dosen::query();

            if ($request->has('prodi') && $request->prodi != '') {
                $usersQuery->where('prodi_id', $request->prodi);
                $dosensQuery->where('prodi_id', $request->prodi); 
            }
            if ($request->has('search') && $request->search != '') {
                $searchTerm = $request->search;
                $usersQuery->where(function ($q) use ($searchTerm) {
                    $q->where('name', 'like', "%{$searchTerm}%");
                });
                $dosensQuery->where(function ($q) use ($searchTerm) {
                    $q->where('name', 'like', "%{$searchTerm}%");
                });
            }

            $query = $dosensQuery->union($usersQuery);
            if ($request->has('sort')) {
                if ($request->sort == 'nameasc') {
                    $query->orderBy('name', 'asc');
                } elseif ($request->sort == 'namedsc') {
                    $query->orderBy('name', 'desc');
                } 
            }

        }
        $mahasiswa = User::all();
        $dosen = Dosen::all();
        $users = $query->paginate(10);
        $programStudi = Prodi::all(); 
        $footer = Footer::getData();
        return view('dosen.pengguna', compact('mahasiswa', 'dosen', 'users', 'programStudi', 'footer'));
    }

}


?>