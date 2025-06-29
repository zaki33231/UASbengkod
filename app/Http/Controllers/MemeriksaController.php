<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Periksa;
use App\Models\User;
use App\Models\Obat;
use App\Models\DaftarPoli;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MemeriksaController extends Controller
{
    public function index()
    {
        // Ambil user yang sedang login
        $user = auth()->user();
        $dokter = $user->dokter;

        // Ambil data pemeriksaan dari database
        $periksas = Periksa::whereHas('daftarPoli.jadwal', function ($query) use ($dokter) {
            $query->where('dokter_id', $dokter->id);
        })->with(['daftarPoli.pasien', 'daftarPoli.jadwal.dokter', 'detailPeriksa'])->get();

        return view('dokter.memeriksa', compact('periksas'));
    }

    public function create()
    {
        return view('dokter.memeriksa.create');
    }

    public function store(Request $request)
    {
        // Simpan data pemeriksaan ke database
        // ...
        return redirect()->route('dokter.memeriksa')->with('success', 'Pemeriksaan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $periksa = Periksa::with(['detailPeriksa.obat', 'daftarPoli.pasien'])->findOrFail($id);
        $obats = Obat::select('id', 'nama_obat', 'harga')->get();

        return view('dokter.editperiksa', compact('periksa', 'obats'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'tgl_periksa' => 'required|date',
            'catatan' => 'required|string',
            'status' => 'required|in:Menunggu,Dalam Proses,Selesai,Batal',
            'obat_id' => 'nullable|array',
            'obat_id.*' => 'exists:obat,id'
        ]);

        DB::beginTransaction();
        try {
            // Ambil data pemeriksaan berdasarkan ID
            $periksa = Periksa::findOrFail($id);

            // Update tabel periksa
            $periksa->update([
                'tgl_periksa' => $request->tgl_periksa,
                'catatan' => $request->catatan,
                'status' => $request->status,
                'biaya_periksa' => 150000 // biaya default
            ]);

            // Update status di daftar poli juga
            $periksa->daftarPoli->update(['status' => $request->status]);

            // Hapus detail periksa yang lama
            $periksa->detailPeriksa()->delete();

            // Simpan obat-obat yang dipilih
            if ($request->has('obat_id')) {
                foreach ($request->obat_id as $obatId) {
                    $periksa->detailPeriksa()->create([
                        'id_obat' => $obatId,
                        'jumlah' => 1 // Bisa ditambahkan input jumlah jika diperlukan
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('dokter.memeriksa')
                ->with('success', 'Status pemeriksaan berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function updateStatus($id)
    {
        DB::beginTransaction();
        try {
            $periksa = Periksa::findOrFail($id);
            $periksa->update(['status' => 'Selesai']);

            // Update status di daftar poli juga
            $periksa->daftarPoli->update(['status' => 'Selesai']);

            DB::commit();
            return redirect()->route('dokter.memeriksa')
                ->with('success', 'Status pemeriksaan berhasil diubah menjadi Selesai.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}