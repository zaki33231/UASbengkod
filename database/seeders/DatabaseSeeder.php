<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Poli;
use App\Models\Dokter;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Buat Poli
        $poliGigi = Poli::create([
            'nama_poli' => 'Poli Gigi',
            'keterangan' => 'Menangani masalah kesehatan gigi dan mulut'
        ]);

        $poliUmum = Poli::create([
            'nama_poli' => 'Poli Umum',
            'keterangan' => 'Menangani masalah kesehatan umum'
        ]);

        // Buat User Dokter
        $dokterGigi = User::create([
            'nama' => 'Dr. Towa',
            'alamat' => 'Jl. Tokoyami No. 2',
            'no_hp' => '08123456789',
            'email' => 'dokter.gigi@gmail.com',
            'role' => 'dokter',
            'password' => bcrypt('password')
        ]);

        $dokterUmum = User::create([
            'nama' => 'Dr. Asumi',
            'alamat' => 'Jl. Sena No. 2',
            'no_hp' => '08987654321',
            'email' => 'dokter.umum@gmail.com',
            'role' => 'dokter',
            'password' => bcrypt('password')
        ]);

        // Buat data Dokter
        Dokter::create([
            'nama' => 'Dr. Towa',
            'alamat' => 'Jl. Gigi No. 1',
            'email' => 'dokter.gigi@gmail.com',
            'nama_poli' => 'Poli Gigi',
            'no_hp' => '08123456789',
            'poli_id' => $poliGigi->id,
            'user_id' => $dokterGigi->id
        ]);

        Dokter::create([
            'nama' => 'Dr. Asumi',
            'alamat' => 'Jl. Umum No. 1',
            'email' => 'dokter.umum@gmail.com',
            'nama_poli' => 'Poli Umum',
            'no_hp' => '08987654321',
            'poli_id' => $poliUmum->id,
            'user_id' => $dokterUmum->id
        ]);

        // Panggil seeder lainnya
        $this->call([
            UserSeeder::class,
            AdminSeeder::class,
            JadwalPeriksaSeeder::class,
        ]);
    }
}