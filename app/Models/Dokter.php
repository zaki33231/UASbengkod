<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    use HasFactory;

    protected $table = 'dokters';

    protected $fillable = [
        'nama',
        'alamat',
        'no_hp',
        'poli_id',
        'user_id',
        'email',
        'nama_poli'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function poli()
    {
        return $this->belongsTo(Poli::class);
    }

    public function jadwalPeriksa()
    {
        return $this->hasMany(JadwalPeriksa::class);
    }
}