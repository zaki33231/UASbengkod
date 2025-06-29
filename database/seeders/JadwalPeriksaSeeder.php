<?php

namespace Database\Seeders;

use App\Models\JadwalPeriksa;
use App\Models\User;
use Illuminate\Database\Seeder;

class JadwalPeriksaSeeder extends Seeder
{
    public function run(): void
    {
        // Dapatkan dokter gigi
        $dokterGigi = User::where('email', 'dokter.gigi@gmail.com')->first();

        // Buat jadwal untuk dokter gigi
        JadwalPeriksa::create([
            'dokter_id' => $dokterGigi->id,
            'hari' => 'Senin',
            'jam_mulai' => '08:00',
            'jam_selesai' => '12:00',
            'status' => 'Aktif'
        ]);

        JadwalPeriksa::create([
            'dokter_id' => $dokterGigi->id,
            'hari' => 'Rabu',
            'jam_mulai' => '13:00',
            'jam_selesai' => '17:00',
            'status' => 'Aktif'
        ]);

        // Dapatkan dokter umum
        $dokterUmum = User::where('email', 'dokter.umum@gmail.com')->first();

        // Buat jadwal untuk dokter umum
        JadwalPeriksa::create([
            'dokter_id' => $dokterUmum->id,
            'hari' => 'Selasa',
            'jam_mulai' => '08:00',
            'jam_selesai' => '12:00',
            'status' => 'Aktif'
        ]);

        JadwalPeriksa::create([
            'dokter_id' => $dokterUmum->id,
            'hari' => 'Kamis',
            'jam_mulai' => '13:00',
            'jam_selesai' => '17:00',
            'status' => 'Aktif'
        ]);
    }
}