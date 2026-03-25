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
            // Keterlambatan
            // Keterlambatan
            ['kriteria_id' => 1, 'nama' => '0 - 5 Kali', 'bobot' => 5, 'min_value' => 0, 'max_value' => 5],
            ['kriteria_id' => 1, 'nama' => '6 - 10 Kali', 'bobot' => 4, 'min_value' => 6, 'max_value' => 10],
            ['kriteria_id' => 1, 'nama' => '11 - 15 Kali', 'bobot' => 3, 'min_value' => 11, 'max_value' => 15],
            ['kriteria_id' => 1, 'nama' => '16 - 20 Kali', 'bobot' => 2, 'min_value' => 16, 'max_value' => 20],
            ['kriteria_id' => 1, 'nama' => '> 20 Kali', 'bobot' => 1, 'min_value' => 21, 'max_value' => 1000],

            // MASA KERJA (kriteria_id = 2)
            ['kriteria_id' => 2, 'nama' => '>=10 Tahun ', 'bobot' => 5, 'min_value' => 10, 'max_value' => 100],
            ['kriteria_id' => 2, 'nama' => '6 - 9 Tahun', 'bobot' => 4, 'min_value' => 6, 'max_value' => 9],
            ['kriteria_id' => 2, 'nama' => '3 - 5 Tahun', 'bobot' => 3, 'min_value' => 3, 'max_value' => 5],
            ['kriteria_id' => 2, 'nama' => '2 Tahun ', 'bobot' => 2, 'min_value' => 2, 'max_value' => 2],
            ['kriteria_id' => 2, 'nama' => '1 Tahun', 'bobot' => 1, 'min_value' => 0, 'max_value' => 1],

            // Trip Objek (kriteria_id = 3)
            ['kriteria_id' => 3, 'nama' => '>=300 Trip', 'bobot' => 5, 'min_value' => 300, 'max_value' => 5000],
            ['kriteria_id' => 3, 'nama' => '200 - 299 Trip', 'bobot' => 4, 'min_value' => 200, 'max_value' => 299],
            ['kriteria_id' => 3, 'nama' => '100 - 199 Trip', 'bobot' => 3, 'min_value' => 100, 'max_value' => 199],
            ['kriteria_id' => 3, 'nama' => '50 - 99 Trip', 'bobot' => 2, 'min_value' => 50, 'max_value' => 99],
            ['kriteria_id' => 3, 'nama' => '< 50 Trip', 'bobot' => 1, 'min_value' => 1, 'max_value' => 49],

            // Total Trip Barang (kriteria_id = 4)
            ['kriteria_id' => 4, 'nama' => '>= 200 Trip ', 'bobot' => 5, 'min_value' => 200, 'max_value' => 1000],
            ['kriteria_id' => 4, 'nama' => '150-199 Trip', 'bobot' => 4, 'min_value' => 150, 'max_value' => 199],
            ['kriteria_id' => 4, 'nama' => '100-149 Trip', 'bobot' => 3, 'min_value' => 100, 'max_value' => 149],
            ['kriteria_id' => 4, 'nama' => '>50 - 99 Trip', 'bobot' => 2, 'min_value' => 50, 'max_value' => 99],
            ['kriteria_id' => 4, 'nama' => '>50 - 99 Trip', 'bobot' => 1, 'min_value' => 1, 'max_value' => 49],

            // PELANGGARAN (kriteria_id = 4)
            ['kriteria_id' => 5, 'nama' => '> 13 Kali', 'bobot' => 1, 'min_value' => 13, 'max_value' => 1000],
            ['kriteria_id' => 5, 'nama' => '10 - 12 kali ', 'bobot' => 2, 'min_value' => 10, 'max_value' => 12],
            ['kriteria_id' => 5, 'nama' => '7 - 9 kali ', 'bobot' => 3, 'min_value' => 7, 'max_value' => 9],
            ['kriteria_id' => 5, 'nama' => '4 - 6 kali ', 'bobot' => 4, 'min_value' => 4, 'max_value' => 6],
            ['kriteria_id' => 5, 'nama' => '0 - 3 kali ', 'bobot' => 5, 'min_value' => 0, 'max_value' => 3],
        ]);
    }
}
