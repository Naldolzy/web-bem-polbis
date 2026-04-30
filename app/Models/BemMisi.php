<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BemMisi extends Model
{
    protected $table = 'bem_misi';

    protected $fillable = ['isi', 'urutan'];

    /**
     * Returns all misi ordered by urutan then id.
     */
    public static function getAllOrdered(): Collection
    {
        return static::orderBy('urutan')->orderBy('id')->get();
    }
}
