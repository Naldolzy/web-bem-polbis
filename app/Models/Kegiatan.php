<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Kegiatan extends Model
{
    protected $fillable = [
        'judul',
        'slug',
        'deskripsi',
        'konten',
        'foto',
        'kategori',
        'tanggal_kegiatan',
        'is_published',
    ];

    protected $casts = [
        'tanggal_kegiatan' => 'date',
        'is_published'     => 'boolean',
    ];

    /**
     * Use booted() instead of boot() as per Laravel 11+ convention.
     */
    protected static function booted(): void
    {
        static::creating(function (self $kegiatan) {
            if (empty($kegiatan->slug)) {
                $kegiatan->slug = Str::slug($kegiatan->judul) . '-' . time();
            }
        });
    }

    /**
     * Modern Laravel 9+ accessor using Attribute cast.
     */
    protected function fotoUrl(): Attribute
    {
        return Attribute::get(fn () => $this->foto
            ? asset('storage/' . $this->foto)
            : asset('images/kegiatan-default.jpg'));
    }

    /**
     * Scope for published kegiatan. Type-hinted for Laravel 13 compatibility.
     */
    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
    }
}
