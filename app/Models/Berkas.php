<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Berkas extends Model
{
    protected $table = 'berkas';
    protected $fillable = [
        'pelamar_id',
        'jenis',
        'file',
    ];

    public function pelamar()
    {
        return $this->belongsTo(Pelamar::class);
    }
}
