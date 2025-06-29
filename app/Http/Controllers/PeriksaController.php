<?php

namespace App\Http\Controllers;

use App\Models\DaftarPoli;
use App\Models\JadwalPeriksa;
use App\Models\Poli;
use App\Models\User;
use App\Models\Dokter;
use App\Models\Periksa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class PeriksaController extends Controller
{
    public function index()
    {
        $polis = Poli::all();
        $riwayat = DaftarPoli::where('pasien_id', Auth::user()->pasien->id)
            ->with(['poli', 'jadwal.dokter'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pasien.periksa', compact('polis', 'riwayat'));
    }

    public function getJadwal($poliId)
    {
        try {
            Log::info('Mencari jadwal untuk poli ID: ' . $poliId);

            // Dapatkan dokter yang bekerja di poli tersebut
            $dokter = Dokter::where('poli_id', $poliId)->first();

            if (!$dokter) {
                Log::error('Tidak ada dokter yang ditemukan untuk poli ID: ' . $poliId);
                return response()->json(['error' => 'Dokter tidak ditemukan'], 404);
            }

            Log::info('Dokter ditemukan: ' . $dokter->nama);

            // Dapatkan jadwal yang aktif dari dokter tersebut
            $jadwals = JadwalPeriksa::where('dokter_id', $dokter->id)
                ->where('status', 'Aktif')
                ->with('dokter.user:id,nama')
                ->get();

            $formattedJadwals = $jadwals->map(function ($jadwal) {
                return [
                    'id' => $jadwal->id,
                    'dokter' => [
                        'nama' => $jadwal->dokter->user->nama
                    ],
                    'hari' => $jadwal->hari,
                    'jam_mulai' => $jadwal->jam_mulai,
                    'jam_selesai' => $jadwal->jam_selesai,
                    'status' => $jadwal->status
                ];
            });

            Log::info('Jumlah jadwal yang ditemukan: ' . $jadwals->count());
            Log::info('Detail jadwal: ' . json_encode($formattedJadwals));

            return response()->json($formattedJadwals);
        } catch (\Exception $e) {
            Log::error('Error dalam getJadwal: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'poli_id' => 'required|exists:polis,id',
            'jadwal_id' => 'required|exists:jadwal_periksa,id',
            'keluhan' => 'required|string'
        ]);

        DB::beginTransaction();
        try {
            // Hitung nomor antrian
            $antrian = DaftarPoli::where('jadwal_id', $request->jadwal_id)
                ->whereDate('created_at', today())
                ->count() + 1;

            // Buat pendaftaran poli
            $daftarPoli = DaftarPoli::create([
                'pasien_id' => Auth::user()->pasien->id,
                'poli_id' => $request->poli_id,
                'jadwal_id' => $request->jadwal_id,
                'keluhan' => $request->keluhan,
                'no_antrian' => $antrian,
                'status' => 'Menunggu'
            ]);

            // Buat data periksa
            Periksa::create([
                'daftar_poli_id' => $daftarPoli->id,
                'status' => 'Menunggu'
            ]);

            DB::commit();
            return redirect()->route('pasien.periksa')
                ->with('success', 'Berhasil mendaftar poli. Nomor antrian Anda: ' . $antrian);
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error dalam store: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function batal($id)
    {
        DB::beginTransaction();
        try {
            $daftar = DaftarPoli::where('id', $id)
                ->where('pasien_id', Auth::user()->pasien->id)
                ->where('status', 'Menunggu')
                ->firstOrFail();

            // Update status daftar poli dan periksa menjadi Batal
            $daftar->update(['status' => 'Batal']);
            $daftar->periksa->update(['status' => 'Batal']);

            DB::commit();
            return redirect()->route('pasien.periksa')
                ->with('success', 'Pendaftaran berhasil dibatalkan');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error dalam batal: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}