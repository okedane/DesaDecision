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
                'nama' => 'Keterlambatan',
                'bobot' => 15,
                'sifat' => 'cost',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode' => 'C2',
                'nama' => 'Masa Kerja',
                'bobot' => 15,
                'sifat' => 'benefit',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode' => 'C3',
                'nama' => 'Total Trip Ojek',
                'bobot' => 25,
                'sifat' => 'benefit',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode' => 'C4',
                'nama' => 'Total Trip Barang',
                'bobot' => 25,
                'sifat' => 'benefit',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode' => 'C5',
                'nama' => 'Kesalahan Pengiriman',
                'bobot' => 20,
                'sifat' => 'cost',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
