<?php

namespace Database\Seeders;

use Attribute;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User::create([
        //     'nama' => 'Dokter Towa',
        //     'alamat' => 'Jl. Tokoyami No. 2',
        //     'no_hp' => '08123456789',
        //     'email' => 'doktertowa@gmail.com',
        //     'role' => 'dokter',
        //     'password' => bcrypt('dokter123'),
        // ]);

        // User::create([
        //     'nama' => 'Doremi',
        //     'alamat' => 'Jl. Doko Remi No. 3',
        //     'no_hp' => '08987654321',
        //     'email' => 'doremi@gmail.com',
        //     'role' => 'pasien',
        //     'password' => bcrypt('pasien123'),
        // ]);
    }
}