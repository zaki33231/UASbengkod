<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dokter;
use App\Models\Obat;
use App\Models\Pasien;
use App\Models\Poli;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'total_poli' => Poli::count(),
            'total_dokter' => Dokter::count(),
            'total_pasien' => Pasien::count(),
            'total_obat' => Obat::count(),
        ];

        return view('admin.dashboard', $data);
    }
}