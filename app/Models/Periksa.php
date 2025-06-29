<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Periksa extends Model
{
    protected $table = 'periksa';

    protected $fillable = [
        'daftar_poli_id',
        'tgl_periksa',
        'catatan',
        'biaya_periksa',
        'status'
    ];

    // Memberikan nilai default untuk status
    protected $attributes = [
        'status' => 'Menunggu'
    ];

    public function daftarPoli()
    {
        return $this->belongsTo(DaftarPoli::class, 'daftar_poli_id');
    }

    public function detailPeriksa()
    {
        return $this->hasMany(DetailPeriksa::class, 'id_periksa');
    }

    // Accessor untuk mendapatkan data pasien melalui daftar poli
    public function getPasienAttribute()
    {
        return $this->daftarPoli->pasien;
    }

    // Accessor untuk mendapatkan data dokter melalui daftar poli
    public function getDokterAttribute()
    {
        return $this->daftarPoli->jadwal->dokter;
    }
}