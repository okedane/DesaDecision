<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PendaftaranSeeder extends Seeder
{
    public function run(): void
    {
        $pelamarIds = DB::table('pelamar')->pluck('id');

        foreach ($pelamarIds as $pelamarId) {
            DB::table('pendaftaran')->updateOrInsert(
                ['pelamar_id' => $pelamarId],
                [
                    'tanggal_daftar' => now()->toDateString(),
                    'status' => 'menunggu',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
