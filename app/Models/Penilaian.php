<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penilaian extends Model
{
    use HasFactory;

    protected $table = 'penilaians';

    protected $fillable = [
        'pelamar_id',
        'kriteria_id',
        'nilai'
    ];

    // RELASI
    public function pelamar()
    {
        return $this->belongsTo(Pelamar::class);
    }

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class);
    }
}
