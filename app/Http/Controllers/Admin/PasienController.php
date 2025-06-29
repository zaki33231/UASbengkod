<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pasien;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PasienController extends Controller
{
    public function index()
    {
        $pasiens = Pasien::with('user')->paginate(10);
        return view('admin.pasien.index', compact('pasiens'));
    }

    public function create()
    {
        return view('admin.pasien.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'no_ktp' => 'required|string|unique:pasiens,no_ktp',
            'alamat' => 'required|string',
            'no_hp' => 'required|string',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        DB::beginTransaction();
        try {
            // Buat user baru
            $user = User::create([
                'nama' => $request->nama,
                'email' => $request->email,
                'no_ktp' => $request->no_ktp,
                'alamat' => $request->alamat,
                'no_hp' => $request->no_hp,
                'password' => Hash::make($request->password),
                'role' => 'pasien'
            ]);

            // Generate nomor rekam medis
            $lastPasien = Pasien::orderBy('created_at', 'desc')->first();
            $noRM = $lastPasien ? sprintf('%06d', intval(substr($lastPasien->no_rm, -6)) + 1) : '000001';

            // Buat pasien baru
            Pasien::create([
                'no_rm' => $noRM,
                'nama' => $request->nama,
                'email' => $request->email,
                'no_ktp' => $request->no_ktp,
                'alamat' => $request->alamat,
                'no_hp' => $request->no_hp,
                'user_id' => $user->id
            ]);

            DB::commit();
            return redirect()->route('admin.pasien.index')->with('success', 'Data pasien berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    public function edit(Pasien $pasien)
    {
        return view('admin.pasien.edit', compact('pasien'));
    }

    public function update(Request $request, Pasien $pasien)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'no_ktp' => 'required|string|unique:pasiens,no_ktp,' . $pasien->id,
            'alamat' => 'required|string',
            'no_hp' => 'required|string',
            'password' => 'nullable|string|min:8',
        ]);

        try {
            DB::beginTransaction();

            // Update data pasien
            $pasien->update([
                'nama' => $request->nama,
                'no_ktp' => $request->no_ktp,
                'alamat' => $request->alamat,
                'no_hp' => $request->no_hp,
            ]);

            // Update user terkait
            if ($pasien->user) {
                $pasien->user->nama = $request->nama;

                // Update password jika diisi
                if ($request->filled('password')) {
                    $pasien->user->password = Hash::make($request->password);
                }

                $pasien->user->save();
            }

            DB::commit();

            return redirect()->route('admin.pasien.index')->with('success', 'Data pasien berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy(Pasien $pasien)
    {
        try {
            DB::beginTransaction();

            // Hapus user terkait
            $pasien->user->delete();

            // Hapus data pasien
            $pasien->delete();

            DB::commit();
            return redirect()->route('admin.pasien.index')->with('success', 'Data pasien berhasil dihapus');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}