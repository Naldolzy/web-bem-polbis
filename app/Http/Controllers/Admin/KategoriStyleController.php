<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class KategoriStyleController extends Controller
{
    public function index(): View
    {
        $savedStyles = json_decode(SiteSetting::get('kategori_styles', '{}'), true) ?? [];

        // Ambil semua kategori unik dari DB kegiatan
        $existingKategori = Kegiatan::distinct()->pluck('kategori')->toArray();

        // Gabungkan dengan kategori yang sudah punya style tersimpan
        $allKategori = array_unique(array_merge($existingKategori, array_keys($savedStyles)));
        sort($allKategori);

        return view('admin.kategori-style.index', compact('savedStyles', 'allKategori'));
    }

    public function update(Request $request): RedirectResponse
    {
        $namaList   = $request->input('kategori', []);
        $bgFromList = $request->input('bg_from', []);
        $bgToList   = $request->input('bg_to', []);
        $textList   = $request->input('text_color', []);
        $iconList   = $request->input('icon', []);

        $styles = [];
        foreach ($namaList as $i => $nama) {
            $nama = strtolower(trim((string) $nama));
            if ($nama === '') continue;

            $bgFrom = $bgFromList[$i] ?? '#1565C0';
            $styles[$nama] = [
                'bg_from' => $bgFrom,
                'bg_to'   => $bgToList[$i]  ?? $bgFrom,
                'text'    => $textList[$i]   ?? '#ffffff',
                'icon'    => trim((string) ($iconList[$i] ?? '')),
            ];
        }

        SiteSetting::set('kategori_styles', json_encode($styles));

        return back()->with('success', 'Gaya kategori berhasil disimpan!');
    }
}
