<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class KriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kriterias')->insert([
            [
                'kode' => 'C1',
                'nama' => 'Tes Praktek Keterampilan',
                'bobot' => 25,
                'sifat' => 'benefit',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode' => 'C2',
                'nama' => 'Jenjang Pendidikan Terakhir',
                'bobot' => 20,
                'sifat' => 'benefit',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode' => 'C3',
                'nama' => 'Pengalaman Kerja',
                'bobot' => 20,
                'sifat' => 'benefit',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode' => 'C4',
                'nama' => 'Tes Wawancara',
                'bobot' => 20,
                'sifat' => 'benefit',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode' => 'C5',
                'nama' => 'Tes Tulis',
                'bobot' => 15,
                'sifat' => 'benefit',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
