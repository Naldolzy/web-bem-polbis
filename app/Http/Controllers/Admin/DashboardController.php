<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use App\Models\Struktur;

class DashboardController extends Controller
{
    public function index()
    {
        $total_kegiatan = Kegiatan::count();
        $kegiatan_published = Kegiatan::published()->count();
        $total_anggota = Struktur::count();
        $anggota_aktif = Struktur::active()->count();
        $kegiatan_terbaru = Kegiatan::orderBy('created_at', 'desc')->limit(5)->get();

        return view('admin.dashboard', compact(
            'total_kegiatan',
            'kegiatan_published',
            'total_anggota',
            'anggota_aktif',
            'kegiatan_terbaru'
        ));
    }
}
