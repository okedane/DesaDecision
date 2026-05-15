<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HasilSeleksi extends Model
{
    protected $table = 'hasil_seleksi';

    protected $fillable = [
        'pelamar_id',
        'status',
        'keterangan',
        'tanggal_pengumuman',
    ];

    protected $casts = [
        'tanggal_pengumuman' => 'datetime',
    ];

    public function pelamar()
    {
        return $this->belongsTo(Pelamar::class, 'pelamar_id');
    }
}