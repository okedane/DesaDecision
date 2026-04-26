<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class SubKriteria extends Model
{
    use HasFactory;

    protected $table = 'sub_kriterias';

    protected $fillable = [
        'kriteria_id',
        'nama',
        'bobot',
        'min_value',
        'max_value'
    ];

    // RELASI
    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class);
    }

    
}
