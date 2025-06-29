<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\Pasien;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RiwayatPasienController extends Controller
{
    public function index()
    {
        try {
            // Ambil user yang sedang login (dokter)
            $dokter = Auth::user()->dokter;

            // Ambil semua pasien yang pernah diperiksa oleh dokter ini
            $pasiens = DB::table('pasiens')
                ->select(
                    'pasiens.id',
                    'pasiens.nama',
                    'pasiens.alamat',
                    'pasiens.no_ktp',
                    'pasiens.no_hp',
                    'pasiens.no_rm'
                )
                ->join('daftar_polis', 'pasiens.id', '=', 'daftar_polis.pasien_id')
                ->join('jadwal_periksa', 'daftar_polis.jadwal_id', '=', 'jadwal_periksa.id')
                ->where('jadwal_periksa.dokter_id', $dokter->id)
                ->distinct()
                ->get();

            return view('dokter.riwayat_pasien', compact('pasiens'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function detail($id)
    {
        try {
            $dokter = Auth::user()->dokter;
            $pasien = \App\Models\Pasien::findOrFail($id);

            // Ambil semua periksa milik pasien yang diperiksa oleh dokter ini, status selesai
            $riwayatPeriksa = \App\Models\Periksa::whereHas('daftarPoli', function ($q) use ($id, $dokter) {
                $q->where('pasien_id', $id)
                    ->whereHas('jadwal', function ($q2) use ($dokter) {
                        $q2->where('dokter_id', $dokter->id);
                    });
            })
                ->where('status', 'Selesai')
                ->with(['detailPeriksa.obat', 'daftarPoli'])
                ->orderBy('tgl_periksa', 'desc')
                ->get();

            // Tambahkan properti total_biaya dan obats ke setiap periksa
            foreach ($riwayatPeriksa as $periksa) {
                $totalObat = 0;
                $obats = collect();
                foreach ($periksa->detailPeriksa as $detail) {
                    if ($detail->obat) {
                        $obat = $detail->obat;
                        // Cek apakah ada field jumlah di detail_periksa
                        $jumlah = isset($detail->jumlah) ? $detail->jumlah : 1;
                        $obatItem = clone $obat;
                        $obatItem->jumlah = $jumlah;
                        $obats->push($obatItem);
                        $totalObat += $obat->harga * $jumlah;
                    }
                }
                $periksa->obats = $obats;
                $periksa->total_biaya = ($periksa->biaya_periksa ?? 0) + $totalObat;
            }

            return view('dokter.detail_riwayat_pasien', compact('pasien', 'riwayatPeriksa'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}