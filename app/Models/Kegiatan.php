<?php

namespace App\Models;

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
        'is_published' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($kegiatan) {
            if (empty($kegiatan->slug)) {
                $kegiatan->slug = Str::slug($kegiatan->judul) . '-' . time();
            }
        });
    }

    public function getFotoUrlAttribute(): string
    {
        if ($this->foto) {
            return asset('storage/' . $this->foto);
        }
        return asset('images/kegiatan-default.jpg');
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }
}
