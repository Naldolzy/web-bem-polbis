<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Struktur extends Model
{
    protected $fillable = [
        'nama',
        'jabatan',
        'divisi',
        'foto',
        'nim',
        'urutan',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'urutan'    => 'integer',
    ];

    /**
     * Modern Laravel 9+ accessor using Attribute cast.
     */
    protected function fotoUrl(): Attribute
    {
        return Attribute::get(fn () => $this->foto
            ? asset('storage/' . $this->foto)
            : asset('images/avatar-default.png'));
    }

    /**
     * Scope for active struktur. Type-hinted for Laravel 13 compatibility.
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true)->orderBy('urutan');
    }
}
