<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TitikSampel extends Model
{
    use HasFactory;

    /**
     * Tabel yang digunakan model ini.
     * Jika mengikuti konvensi Laravel, nama tabelnya 'titik_sampels'.
     */
    protected $table = 'titik_sampels';

    /**
     * Atribut yang boleh diisi secara mass assignment.
     */
    protected $fillable = [
        'nama',
        'longitude',
        'latitude',
    ];
}
