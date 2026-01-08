<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $table = 'pendaftaran';

    protected $fillable = [
        'pelamar_id',
        'tanggal_daftar',
        'status'
    ];

    // RELASI
    public function pelamar()
    {
        return $this->belongsTo(Pelamar::class);
    }

    public function jadwalInterview()
    {
        return $this->hasOne(JadwalInterview::class);
    }

    public function penilaian()
    {
        return $this->hasMany(Penilaian::class);
    }

    public function hasil()
    {
        return $this->hasOne(Hasil::class);
    }
}
