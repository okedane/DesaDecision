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

        $pelamars = [
            [
                'email' => 'suri@gmail.com',
                'name' => 'suri',
                'password' => bcrypt('12345678'),
                'role' => 'pelamar',
            ],
            [
                'email' => 'ahmadi@gmail.com',
                'name' => 'ahmadi',
                'password' => bcrypt('12345678'),
                'role' => 'pelamar',
            ],
            [
                'email' => 'suparto@gmail.com',
                'name' => 'suparto',
                'password' => bcrypt('12345678'),
                'role' => 'pelamar',
            ],
            [
                'email' => 'sitinuraisyah@gmail.com',
                'name' => 'siti nur aisyah',
                'password' => bcrypt('12345678'),
                'role' => 'pelamar',
            ],
            [
                'email' => 'sitiaisyah@gmail.com',
                'name' => 'siti aisyah',
                'password' => bcrypt('12345678'),
                'role' => 'pelamar',
            ],
            [
                'email' => 'ach.busri@gmail.com',
                'name' => 'ach. busri',
                'password' => bcrypt('12345678'),
                'role' => 'pelamar',
            ],
        ];

        foreach ($pelamars as $pelamar) {
            DB::table('users')->updateOrInsert(
                ['email' => $pelamar['email']],
                [
                    'name' => $pelamar['name'],
                    'password' => $pelamar['password'],
                    'role' => $pelamar['role'],
                ]
            );
        }
    }
}