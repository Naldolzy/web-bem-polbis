<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BemMisi extends Model
{
    protected $table = 'bem_misi';
    protected $fillable = ['isi', 'urutan'];

    public static function getAllOrdered()
    {
        return static::orderBy('urutan')->orderBy('id')->get();
    }
}
