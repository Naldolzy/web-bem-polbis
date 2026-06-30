<?php

namespace App\Http\Controllers;

use App\Models\BemMisi;
use App\Models\Kegiatan;
use App\Models\Ormawa;
use App\Models\ProfilBem;
use App\Models\SiteSetting;
use App\Models\Struktur;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function beranda()
    {
        $profil = ProfilBem::getAllAsArray();
        $misi = BemMisi::getAllOrdered()->take(4);
        $kegiatan_terbaru = Kegiatan::published()
            ->orderBy('tanggal_kegiatan', 'desc')
            ->limit(6)
            ->get();
        return view('public.beranda', compact('profil', 'misi', 'kegiatan_terbaru'));
    }

    public function tentang()
    {
        $profil = ProfilBem::getAllAsArray();
        $misi   = BemMisi::getAllOrdered();
        return view('public.tentang', compact('profil', 'misi'));
    }

    public function kegiatan(Request $request)
    {
        $profil = ProfilBem::getAllAsArray();
        $query  = Kegiatan::published()->orderBy('tanggal_kegiatan', 'desc');

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        $kegiatan       = $query->paginate(9);
        $kategori_list  = Kegiatan::published()->distinct()->pluck('kategori');
        $kategoriStyles = json_decode(SiteSetting::get('kategori_styles', '{}'), true) ?? [];

        return view('public.kegiatan.index', compact('profil', 'kegiatan', 'kategori_list', 'kategoriStyles'));
    }

    public function kegiatanDetail(string $slug)
    {
        try {
            $profil   = ProfilBem::getAllAsArray();
            $kegiatan = Kegiatan::published()->where('slug', $slug)->firstOrFail();
            $related  = Kegiatan::published()
                ->where('id', '!=', $kegiatan->id)
                ->orderBy('tanggal_kegiatan', 'desc')
                ->limit(3)
                ->get();

            return view('public.kegiatan.show', compact('profil', 'kegiatan', 'related'));
        } catch (\Throwable $e) {
            dd([
                'error_message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
        }
    }

    public function struktur()
    {
        $profil   = ProfilBem::getAllAsArray();
        $struktur = Struktur::active()->get()->groupBy('divisi');
        return view('public.struktur', compact('profil', 'struktur'));
    }

    public function ormawa()
    {
        $profil  = ProfilBem::getAllAsArray();
        $ormawas = Ormawa::active()->orderBy('urutan')->orderBy('id')->get();
        return view('public.ormawa', compact('profil', 'ormawas'));
    }

    public function kontak()
    {
        $profil = ProfilBem::getAllAsArray();
        return view('public.kontak', compact('profil'));
    }
}
