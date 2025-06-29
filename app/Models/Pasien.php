<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;

    protected $table = 'pasiens';

    protected $fillable = [
        'no_rm',
        'nama',
        'alamat',
        'no_ktp',
        'no_hp',
        'user_id',
        'email'
    ];

    // Relasi dengan model DaftarPoli
    public function daftarPoli()
    {
        return $this->hasMany(DaftarPoli::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Generate nomor rekam medis otomatis
    public static function generateNoRM()
    {
        // Ambil tahun sekarang
        $tahun = date('Y');

        // Ambil nomor urut terakhir untuk tahun ini
        $lastPatient = self::where('no_rm', 'like', $tahun . '%')
            ->orderBy('no_rm', 'desc')
            ->first();

        if ($lastPatient) {
            // Jika sudah ada pasien dengan tahun ini, increment nomor urut
            $lastNumber = intval(substr($lastPatient->no_rm, -4));
            $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        } else {
            // Jika belum ada pasien dengan tahun ini, mulai dari 0001
            $newNumber = '0001';
        }

        // Format: YYYY-XXXX (contoh: 2024-0001)
        return $tahun . '-' . $newNumber;
    }

    // Cek apakah pasien sudah terdaftar berdasarkan no KTP
    public static function isRegistered($no_ktp)
    {
        return self::where('no_ktp', $no_ktp)->exists();
    }
}