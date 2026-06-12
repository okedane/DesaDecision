<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubKriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('sub_kriterias')->insert([
            // TES PRAKTEK KETERAMPILAN (kriteria_id = 1)
            
            ['kriteria_id' => 1, 'nama' => 'Buruk', 'bobot' => 1, 'min_value' => 0, 'max_value' => 1],
            ['kriteria_id' => 1, 'nama' => 'Cukup', 'bobot' => 2, 'min_value' => 2, 'max_value' => 2],
            ['kriteria_id' => 1, 'nama' => 'Baik', 'bobot' => 3, 'min_value' => 3, 'max_value' => 3],
            ['kriteria_id' => 1, 'nama' => 'Sangat Baik', 'bobot' => 4, 'min_value' => 4, 'max_value' => 4],
            
            // jenjang Pendidikan Terakhir
            ['kriteria_id' => 2, 'nama' => 'SMA/SEDERAJAT', 'bobot' => 1, 'min_value' => 1, 'max_value' => 1],
            ['kriteria_id' => 2, 'nama' => 'D3', 'bobot' => 2, 'min_value' => 2, 'max_value' => 2],
            ['kriteria_id' => 2, 'nama' => 'S1', 'bobot' => 3, 'min_value' => 3, 'max_value' => 3],
            ['kriteria_id' => 2, 'nama' => 'S2/S3', 'bobot' => 4, 'min_value' => 4, 'max_value' => 4],
      
            // Pengalaman Kerja (kriteria_id = 3)
            ['kriteria_id' => 3, 'nama' => '< 1 Tahun', 'bobot' => 1, 'min_value' => 1, 'max_value' => 1],
            ['kriteria_id' => 3, 'nama' => '1 - 3 Tahun', 'bobot' => 2, 'min_value' => 2, 'max_value' => 2],
            ['kriteria_id' => 3, 'nama' => '3 - 6 Tahun', 'bobot' => 3, 'min_value' => 3, 'max_value' => 3],
            ['kriteria_id' => 3, 'nama' => '>= 7 Tahun', 'bobot' => 4, 'min_value' => 4, 'max_value' => 4],
    

            // Tes Wawancara (kriteria_id = 4)
            ['kriteria_id' => 4, 'nama' => 'Sangat Baik', 'bobot' => 4, 'min_value' => 4, 'max_value' => 4],
            ['kriteria_id' => 4, 'nama' => 'Baik', 'bobot' => 3, 'min_value' => 3, 'max_value' => 3],
            ['kriteria_id' => 4, 'nama' => 'Cukup', 'bobot' => 2, 'min_value' => 2, 'max_value' => 2],
            ['kriteria_id' => 4, 'nama' => 'Kurang', 'bobot' => 1, 'min_value' => 1, 'max_value' => 1],

            // Tes Tulis (kriteria_id = 5)
            ['kriteria_id' => 5, 'nama' => '<60', 'bobot' => 1, 'min_value' => 1, 'max_value' => 60],
            ['kriteria_id' => 5, 'nama' => '60 - 74 ', 'bobot' => 2, 'min_value' => 61, 'max_value' => 74],
            ['kriteria_id' => 5, 'nama' => '75 - 84 ', 'bobot' => 3, 'min_value' => 75, 'max_value' => 84],
            ['kriteria_id' => 5, 'nama' => '>=85 ', 'bobot' => 4, 'min_value' => 85, 'max_value' => 100],
        ]);
    }
}
