<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Hasil extends Model
{
    use HasFactory;

    protected $table = 'hasil';

    protected $fillable = [
        'pendaftaran_id',
        'nilai_preferensi',
        'peringkat'
    ];

    // RELASI
    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class);
    }
}
