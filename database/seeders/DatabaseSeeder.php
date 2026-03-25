<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Kriteria;
use App\Models\SubKriteria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call(KriteriaSeeder::class);
        $this->call(SubKriteriaSeeder::class);
        $this->call(UserSeeder::class);
    }
}
