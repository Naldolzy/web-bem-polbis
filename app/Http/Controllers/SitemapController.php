<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Support\Facades\Cache;

class SitemapController extends Controller
{
    public function index()
    {
        $kegiatan = Cache::remember('sitemap_kegiatan_v2', 3600, function () {
            return Kegiatan::published()
                ->orderBy('updated_at', 'desc')
                ->select('slug', 'updated_at')
                ->get();
        });

        $content = view('sitemap.index', compact('kegiatan'))->render();

        return response($content, 200)
            ->header('Content-Type', 'application/xml');
    }
}
