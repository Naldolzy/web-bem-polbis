<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfilBem extends Model
{
    protected $table = 'profil_bems';

    protected $fillable = ['key', 'value'];

    public static function get(string $key, string $default = ''): string
    {
        $profil = static::where('key', $key)->first();
        return $profil ? ($profil->value ?? $default) : $default;
    }

    public static function set(string $key, ?string $value): void
    {
        static::updateOrCreate(['key' => $key], ['value' => $value]);
    }

    public static function getAllAsArray(): array
    {
        return static::all()->pluck('value', 'key')->toArray();
    }
}
