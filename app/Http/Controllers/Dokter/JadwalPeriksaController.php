<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\JadwalPeriksa;
use App\Models\Dokter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalPeriksaController extends Controller
{
    public function index()
    {
        $jadwals = JadwalPeriksa::where('dokter_id', Auth::user()->dokter->id)
            ->orderBy('hari')
            ->orderBy('jam_mulai')
            ->get();

        return view('dokter.jadwal_periksa.index', compact('jadwals'));
    }

    public function create()
    {
        return view('dokter.jadwal_periksa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'status' => 'required|in:Aktif,Tidak Aktif'
        ]);

        try {
            $dokter = Dokter::where('user_id', Auth::id())->first();
            if (!$dokter) {
                throw new \Exception('Data dokter tidak ditemukan');
            }

            JadwalPeriksa::create([
                'dokter_id' => $dokter->id,
                'hari' => $request->hari,
                'jam_mulai' => $request->jam_mulai,
                'jam_selesai' => $request->jam_selesai,
                'status' => $request->status
            ]);

            return redirect()->route('dokter.jadwal-periksa.index')
                ->with('success', 'Jadwal periksa berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function edit(JadwalPeriksa $jadwalPeriksa)
    {
        return view('dokter.jadwal_periksa.edit', compact('jadwalPeriksa'));
    }

    public function update(Request $request, JadwalPeriksa $jadwalPeriksa)
    {
        $request->validate([
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'status' => 'required|in:Aktif,Tidak Aktif'
        ]);

        try {
            $jadwalPeriksa->update($request->all());

            return redirect()->route('dokter.jadwal-periksa.index')
                ->with('success', 'Jadwal periksa berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy(JadwalPeriksa $jadwalPeriksa)
    {
        try {
            $jadwalPeriksa->delete();
            return redirect()->route('dokter.jadwal-periksa.index')
                ->with('success', 'Jadwal periksa berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}