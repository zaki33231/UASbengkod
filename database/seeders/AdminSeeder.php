<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'nama' => 'Admin',
            'alamat' => 'Jl. admin No. 3',
            'no_hp' => '08567890123',
            'email' => 'admin@admin.com',
            'role' => 'admin',
            'password' => Hash::make('admin123'),
        ]);
    }
}