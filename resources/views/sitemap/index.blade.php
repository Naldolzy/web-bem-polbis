<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="https://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:xsi="https://www.w3.org/2001/XMLSchema-instance"
        xmlns:image="https://www.google.com/schemas/sitemap-image/1.1"
        xsi:schemaLocation="https://www.sitemaps.org/schemas/sitemap/0.9
        https://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">

    {{-- Static Pages --}}
    <url>
        <loc>{{ url('/') }}</loc>
        <lastmod>{{ now()->toAtomString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>{{ url('/tentang') }}</loc>
        <lastmod>{{ now()->toAtomString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc>{{ url('/kegiatan') }}</loc>
        <lastmod>{{ now()->toAtomString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.9</priority>
    </url>
    <url>
        <loc>{{ url('/struktur') }}</loc>
        <lastmod>{{ now()->toAtomString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
    </url>
    <url>
        <loc>{{ url('/ormawa') }}</loc>
        <lastmod>{{ now()->toAtomString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
    </url>
    <url>
        <loc>{{ url('/kontak') }}</loc>
        <lastmod>{{ now()->toAtomString() }}</lastmod>
        <changefreq>yearly</changefreq>
        <priority>0.5</priority>
    </url>

    {{-- Dynamic: Kegiatan --}}
    @foreach($kegiatan as $item)
    <url>
        <loc>{{ url('/kegiatan/' . $item->slug) }}</loc>
        <lastmod>{{ $item->updated_at ? $item->updated_at->toAtomString() : now()->toAtomString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
        @if($item->foto)
        <image:image>
            <image:loc>{{ Storage::url($item->foto) }}</image:loc>
        </image:image>
        @endif
    </url>
    @endforeach

</urlset>
