<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ProfilBem extends Model
{
    protected $table = 'profil_bems';

    protected $fillable = ['key', 'value'];

    /**
     * Get a single profil value by key.
     * Renamed from get() to avoid collision with Eloquent Builder's get() method.
     */
    public static function getValue(string $key, string $default = ''): string
    {
        $profil = static::where('key', $key)->first();
        return $profil ? ($profil->value ?? $default) : $default;
    }

    /**
     * Set (upsert) a profil key-value pair.
     */
    public static function set(string $key, ?string $value): void
    {
        static::updateOrCreate(['key' => $key], ['value' => $value]);
    }

    /**
     * Return all profil data as a flat associative array [key => value].
     */
    public static function getAllAsArray(): array
    {
        return static::all()->pluck('value', 'key')->toArray();
    }
}
