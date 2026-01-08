<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subkriteria extends Model
{
    use HasFactory;

    protected $table = 'subkriteria';

    protected $fillable = [
        'kriteria_id',
        'nama_subkriteria',
        'nilai'
    ];

    // RELASI
    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class);
    }
}
