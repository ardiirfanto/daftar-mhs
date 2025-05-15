<?php

namespace App\Services;

use App\Contracts\AuthInterface;
use App\Models\Mahasiswa;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MahasiswaServices extends AuthServices implements AuthInterface
{

    public function login($user): RedirectResponse
    {
        $authService = new AuthServices();
        $authService->setUser($user);
        $authService->setSessionMahasiswa();
        return redirect()
            ->intended('mahasiswa.dashboard')
            ->with('success', 'Anda Berhasil Login sebagai Mahasiswa');
    }

    public function register(Request $request): RedirectResponse
    {
        DB::beginTransaction();
        try {
            // Mendapatkan role mahasiswa
            $mahasiswaRole = Role::where('name', 'mahasiswa')->first();

            // Membuat user baru
            $dataUser = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role_id' => $mahasiswaRole->id,
            ];
            $user = User::create($dataUser);

            if (!$user) {
                DB::rollback();
                return back()->with('error', 'Gagal menambah user');
            }

            // Membuat data mahasiswa dengan informasi skripsi
            Mahasiswa::create([
                'user_id' => $user->id,
                'nim' => $request->nim,
                'prodi_id' => $request->prodi_id,
                'tahun_masuk' => $request->tahun_masuk,
                'alamat' => $request->alamat,
                'no_hp' => $request->no_hp,
                'status' => 'aktif',
                'judul_skripsi' => $request->judul_skripsi,
                'dosen_pembimbing' => $request->dosen_pembimbing,
                'status_skripsi' => $request->status_skripsi ?? 'belum_mulai',
                'tanggal_mulai_skripsi' => $request->tanggal_mulai_skripsi,
                'tanggal_sidang' => null,
            ]);
            DB::commit();

            // Proses login setelah pendaftaran berhasil
            Auth::login($user);
            $authService = new AuthServices();
            $authService->setUser($user);
            $authService->setSessionMahasiswa();

            return redirect()->intended('mahasiswa.dashboard')
                ->with('success', 'Pendaftaran skripsi berhasil');
        } catch (\Throwable $e) {
            DB::rollback();
            return back()
                ->with('error', $e->getMessage());
        }
    }
}
