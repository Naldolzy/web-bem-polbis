<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Ormawa extends Model
{
    protected $fillable = [
        'nama', 'singkatan', 'prodi', 'logo',
        'deskripsi', 'link_website', 'urutan', 'is_active',
    ];

    protected $casts = ['is_active' => 'boolean'];

    /**
     * Scope for active ormawa. Type-hinted for Laravel 13 compatibility.
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }
}
