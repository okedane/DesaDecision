<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pelamar extends Model
{
    use HasFactory;

    protected $table = 'pelamar';

    protected $fillable = [
        'user_id',
        'nik',
        'nama_lengkap',
        'jenis_kelamin',
        'tanggal_lahir',
        'alamat',
        'no_hp',
        'foto',

    ];

    // RELASI
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pendaftaran()
    {
        return $this->hasMany(Pendaftaran::class);
    }

    public function berkasPerlamar()
    {
        return $this->hasMany(Berkas::class);
    }
}
