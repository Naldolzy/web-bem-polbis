<?php

namespace App\View\Components;

use App\Models\SiteSetting;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BadgeKategori extends Component
{
    /** Parsed style for this category (or null if default). */
    public ?array $style;

    /** Inline style string. */
    public string $badgeStyle;

    /** Lucide icon name (or empty). */
    public string $icon;

    /** All loaded styles (cached per request). */
    protected static ?array $allStyles = null;

    public function __construct(public string $kategori)
    {
        if (static::$allStyles === null) {
            static::$allStyles = json_decode(
                SiteSetting::get('kategori_styles', '{}'), true
            ) ?? [];
        }

        $key         = strtolower(trim($kategori));
        $this->style = static::$allStyles[$key] ?? null;

        if ($this->style) {
            $bgFrom          = $this->style['bg_from'] ?? '#1565C0';
            $bgTo            = $this->style['bg_to']   ?? $bgFrom;
            $text            = $this->style['text']    ?? '#ffffff';
            $this->badgeStyle = "background:linear-gradient(135deg,{$bgFrom},{$bgTo});color:{$text};border:none;";
            $this->icon       = $this->style['icon'] ?? '';
        } else {
            $this->badgeStyle = '';
            $this->icon       = '';
        }
    }

    public function render(): View|Closure|string
    {
        return view('components.badge-kategori');
    }
}
