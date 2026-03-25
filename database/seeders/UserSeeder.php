<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->updateOrInsert(
            ['email' => 'admin@test.com'],
            [
                'name' => 'Ricky',
                'password' => bcrypt('password'),
                'role' => 'admin',
            ]
        );

        DB::table('users')->updateOrInsert(
            ['email' => 'a@gmail.com'],
            [
                'name' => 'a',
                'password' => bcrypt('12345678'),
                'role' => 'pelamar',
            ]
        );

         DB::table('users')->updateOrInsert(
            ['email' => 'b@gmail.com'],
            [
                'name' => 'b',
                'password' => bcrypt('12345678'),
                'role' => 'pelamar',
            ]
        );
         DB::table('users')->updateOrInsert(
            ['email' => 'c@gmail.com'],
            [
                'name' => 'c',
                'password' => bcrypt('12345678'),
                'role' => 'pelamar',
            ]
        );

         DB::table('users')->updateOrInsert(
            ['email' => 'c@gmail.com'],
            [
                'name' => 'c',
                'password' => bcrypt('12345678'),
                'role' => 'pelamar',
            ]
        );
    
    }
}