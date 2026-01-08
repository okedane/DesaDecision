<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kriteria extends Model
{
    use HasFactory;

    protected $table = 'kriteria';

    protected $fillable = [
        'kode',
        'nama_kriteria',
        'bobot',
        'tipe'
    ];

    // RELASI
    public function subkriteria()
    {
        return $this->hasMany(Subkriteria::class);
    }

    public function penilaian()
    {
        return $this->hasMany(Penilaian::class);
    }
}
