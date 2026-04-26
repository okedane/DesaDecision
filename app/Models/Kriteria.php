<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\SubKriteria;

class Kriteria extends Model
{
    use HasFactory;

    protected $table = 'kriterias';

    protected $fillable = [
        'kode',
        'nama',
        'bobot',
        'sifat'
    ];

    // RELASI
    public function subkriteria()
    {
        return $this->hasMany(SubKriteria::class);
    }

    public function penilaian()
    {
        return $this->hasMany(Penilaian::class);
    }
}
