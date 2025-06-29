<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Pasien;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();

            // Redirect berdasarkan role
            if (auth()->user()->role === 'admin') {
                return redirect()->route('admin.dashboard')->with('success', 'Selamat datang, Admin!');
            } elseif (auth()->user()->role === 'dokter') {
                return redirect()->route('dokter.dashboard')->with('success', 'Selamat datang, Dokter!');
            } else {
                return redirect()->route('pasien.dashboard')->with('success', 'Selamat datang!');
            }
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput($request->only('email', 'remember'));
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Log untuk debugging
        Log::info('Register method dipanggil');
        Log::info('Data request:', $request->all());

        // Validasi dengan aturan yang sama seperti di PasienController
        try {
            $validated = $request->validate([
                'nama' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
                'alamat' => 'required|string',
                'no_hp' => 'required|string|max:15',
                'no_ktp' => 'required|string|max:16|unique:pasiens,no_ktp', // Pastikan nama table benar
                'terms' => 'required|accepted'
            ], [
                'nama.required' => 'Nama lengkap wajib diisi',
                'email.required' => 'Email wajib diisi',
                'email.email' => 'Format email tidak valid',
                'email.unique' => 'Email sudah terdaftar',
                'password.required' => 'Password wajib diisi',
                'password.min' => 'Password minimal 8 karakter',
                'password.confirmed' => 'Konfirmasi password tidak sama',
                'alamat.required' => 'Alamat wajib diisi',
                'no_hp.required' => 'Nomor HP wajib diisi',
                'no_ktp.required' => 'Nomor KTP wajib diisi',
                'no_ktp.unique' => 'Nomor KTP sudah terdaftar',
                'terms.required' => 'Anda harus menyetujui syarat & ketentuan',
                'terms.accepted' => 'Anda harus menyetujui syarat & ketentuan'
            ]);

            Log::info('Validasi berhasil');

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validasi gagal:', $e->errors());
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput()
                ->with('debug', 'Validasi gagal: ' . json_encode($e->errors()));
        }

        try {
            DB::beginTransaction();
            Log::info('Memulai database transaction');

            // Buat user baru dengan struktur yang sama seperti PasienController
            $user = User::create([
                'nama' => $request->nama,
                'email' => $request->email,
                'alamat' => $request->alamat,
                'no_hp' => $request->no_hp,
                'no_ktp' => $request->no_ktp,
                'password' => Hash::make($request->password),
                'role' => 'pasien'
            ]);

            Log::info('User berhasil dibuat dengan ID: ' . $user->id);

            // Generate nomor rekam medis dengan cara yang sama seperti PasienController
            $lastPasien = Pasien::orderBy('created_at', 'desc')->first();
            $noRM = $lastPasien ? sprintf('%06d', intval(substr($lastPasien->no_rm, -6)) + 1) : '000001';

            Log::info('Nomor RM yang akan digunakan: ' . $noRM);

            // Buat data pasien dengan struktur yang sama seperti PasienController
            $pasien = Pasien::create([
                'no_rm' => $noRM,
                'nama' => $request->nama,
                'email' => $request->email, // Tambahkan email seperti di PasienController
                'alamat' => $request->alamat,
                'no_hp' => $request->no_hp,
                'no_ktp' => $request->no_ktp,
                'user_id' => $user->id
            ]);

            Log::info('Pasien berhasil dibuat dengan ID: ' . $pasien->id);

            DB::commit();
            Log::info('Database transaction berhasil di-commit');

            // Login otomatis setelah registrasi
            Auth::login($user);

            return redirect()->route('pasien.dashboard')
                ->with('success', 'Registrasi berhasil! Nomor Rekam Medis Anda: ' . $pasien->no_rm);

        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error saat registrasi: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());

            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat mendaftar: ' . $e->getMessage())
                ->withInput()
                ->with('debug', 'Error: ' . $e->getMessage());
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Hapus semua session yang tersisa
        $request->session()->flush();

        return redirect('/')->with('success', 'Anda berhasil logout');
    }
}