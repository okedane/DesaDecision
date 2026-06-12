<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PelamarSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil user pelamar
        $users = DB::table('users')->where('role', 'pelamar')->get();

        $data = [
            [
                'nik' => '1234567890123456',
                'nama_lengkap' => 'suri', 
                'jenis_kelamin' => 'Laki-laki',
                'tanggal_lahir' => '2000-01-01',
                'alamat' => 'Sumenep',
                'no_hp' => '081234567890',
            ],
            [
                'nik' => '1234567890123457',
                'nama_lengkap' => 'ahmadi',
                'jenis_kelamin' => 'Laki-laki',
                'tanggal_lahir' => '1999-05-10',
                'alamat' => 'Sumenep',
                'no_hp' => '081234567891',
            ],
            [
                'nik' => '1234567890123458',
                'nama_lengkap' => 'suparto',
                'jenis_kelamin' => 'Laki-laki',
                'tanggal_lahir' => '2001-03-15',
                'alamat' => 'Sumenep',
                'no_hp' => '081234567892',
            ],
            [
                'nik' => '1234567890103459',
                'nama_lengkap' => 'siti nur aisyah',
                'jenis_kelamin' => 'Perempuan',
                'tanggal_lahir' => '2001-03-15',
                'alamat' => 'Sumenep',
                'no_hp' => '081234567833',
            ],

            [
                'nik' => '1234567890123459',
                'nama_lengkap' => 'siti aisyah',
                'jenis_kelamin' => 'Perempuan',
                'tanggal_lahir' => '2001-03-15',
                'alamat' => 'Sumenep',
                'no_hp' => '081234562292',
            ],

             [
                'nik' => '1234567890123460',
                'nama_lengkap' => 'ach. busri',
                'jenis_kelamin' => 'Laki-laki',
                'tanggal_lahir' => '2000-11-20',
                'alamat' => 'Sumenep',
                'no_hp' => '081234562212',
            ],

        ];

        foreach ($data as $item) {
            $user = $users->firstWhere('name', $item['nama_lengkap']);

            if ($user) {
                DB::table('pelamar')->updateOrInsert(
                    ['nik' => $item['nik']],
                    [
                        'user_id' => $user->id,
                        'nama_lengkap' => $item['nama_lengkap'],
                        'jenis_kelamin' => $item['jenis_kelamin'],
                        'tanggal_lahir' => $item['tanggal_lahir'],
                        'alamat' => $item['alamat'],
                        'no_hp' => $item['no_hp'],
                        'foto' => null,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]
                );
            }
        }
    }
}