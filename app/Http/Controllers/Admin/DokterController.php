<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dokter;
use App\Models\Poli;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DokterController extends Controller
{
    public function index()
    {
        $dokters = Dokter::with('poli')->get();
        return view('admin.dokter.index', compact('dokters'));
    }

    public function create()
    {
        $polis = Poli::all();
        return view('admin.dokter.create', compact('polis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'nullable|string|min:8',
            'alamat' => 'required|string',
            'no_hp' => 'required|string|max:20',
            'poli_id' => 'required|exists:polis,id'
        ]);

        try {
            DB::beginTransaction();

            // Buat user untuk dokter
            $user = User::create([
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'email' => $request->email,
                'no_hp' => $request->no_hp,
                'password' => Hash::make($request->password),
                'role' => 'dokter',
            ]);

            // Buat data dokter
            $dokter = Dokter::create([
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'email' => $request->email,
                'no_hp' => $request->no_hp,
                'nama_poli' => Poli::find($request->poli_id)->nama_poli, // Ambil nama poli dari relasi
                'poli_id' => $request->poli_id,
                'user_id' => $user->id
            ]);

            DB::commit();

            return redirect()->route('admin.dokter.index')
                ->with('success', "Dokter berhasil ditambahkan dengan email: {$request->email}");

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function edit(Dokter $dokter)
    {
        $polis = Poli::all();
        return view('admin.dokter.edit', compact('dokter', 'polis'));
    }

    public function update(Request $request, Dokter $dokter)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_hp' => 'required|string|max:20',
            'poli_id' => 'required|exists:polis,id',
            'password' => 'nullable|string|min:8'
        ]);

        try {
            DB::beginTransaction();

            // Update data dokter
            $dokter->update([
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'no_hp' => $request->no_hp,
                'poli_id' => $request->poli_id,
                'nama_poli' => Poli::find($request->poli_id)->nama_poli,
            ]);

            // Update nama user terkait dan password jika ada
            if ($dokter->user) {
                $dokter->user->nama = $request->nama;

                // Update password jika diisi
                if ($request->filled('password')) {
                    $dokter->user->password = Hash::make($request->password);
                }

                $dokter->user->save();
            }

            DB::commit();

            return redirect()->route('admin.dokter.index')
                ->with('success', 'Data dokter berhasil diperbarui');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }


    public function destroy(Dokter $dokter)
    {
        try {
            DB::beginTransaction();

            // Hapus user terkait jika ada
            if ($dokter->user) {
                $dokter->user->delete();
            }

            // Hapus data dokter
            $dokter->delete();

            DB::commit();

            return redirect()->route('admin.dokter.index')
                ->with('success', 'Dokter berhasil dihapus');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}