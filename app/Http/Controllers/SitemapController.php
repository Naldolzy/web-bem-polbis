<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Support\Facades\Cache;

class SitemapController extends Controller
{
    /**
     * Generate sitemap.xml — di-cache 1 jam agar tidak overload DB saat Google crawl.
     */
    public function index()
    {
        $content = Cache::remember('sitemap.xml', 3600, function () {
            $kegiatan = Kegiatan::published()
                ->orderBy('updated_at', 'desc')
                ->select('slug', 'updated_at')
                ->get();

            return view('sitemap.index', compact('kegiatan'))->render();
        });

        return response($content, 200)
            ->header('Content-Type', 'application/xml')
            ->header('Cache-Control', 'public, max-age=3600');
    }

    /**
     * Generate robots.txt secara dinamis agar URL sitemap selalu menggunakan APP_URL.
     * Sehingga tidak perlu hardcode URL di public/robots.txt.
     */
    public function robots()
    {
        $content = "User-agent: *\n";
        $content .= "Allow: /\n\n";
        $content .= "# Disallow admin panel from search engines\n";
        $content .= "Disallow: /bem-admin/\n";
        $content .= "Disallow: /bem-admin/*\n\n";
        $content .= "# Block sensitive paths\n";
        $content .= "Disallow: /.env\n";
        $content .= "Disallow: /vendor/\n\n";
        $content .= "# Sitemap\n";
        $content .= "Sitemap: " . url('/sitemap.xml') . "\n";

        return response($content, 200)
            ->header('Content-Type', 'text/plain');
    }
}
