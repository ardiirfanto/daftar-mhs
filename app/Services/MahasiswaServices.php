<?php

namespace App\Services;

use App\Contracts\AuthInterface;
use App\Models\Mahasiswa;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * Class service untuk menangani proses autentikasi dan pendaftaran Mahasiswa,
 * termasuk pendaftaran skripsi dan logika login.
 *
 * extends dari AuthServices dan implements AuthInterface.
 */
class MahasiswaServices extends AuthServices implements AuthInterface
{
    /**
     * Melakukan login user Mahasiswa dan mengarahkan ke dashboard Mahasiswa.
     *
     * @param User $user Instance user yang akan login.
     * @return RedirectResponse Redirect ke mahasiswa.dashboard dengan pesan sukses.
     */
    public function login($user): RedirectResponse
    {
        // Fungsi Inheritance dengan AuthServices
        $this->setUser($user);
        $this->setSessionMahasiswa();

        return redirect()
            ->route('mahasiswa.dashboard')
            ->with('success', 'Anda Berhasil Login sebagai Mahasiswa');
    }

    /**
     * Mendaftarkan user Mahasiswa baru, membuat data Mahasiswa beserta data skripsi,
     * dan melakukan login setelah pendaftaran berhasil.
     *
     * @param Request $request Request pendaftaran yang berisi data user dan skripsi.
     * @return RedirectResponse Redirect ke mahasiswa.dashboard jika sukses, atau kembali dengan error jika gagal.
     */
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

            // Fungsi Inheritance dengan AuthServices
            $this->setUser($user);
            $this->setSessionMahasiswa();

            return redirect()->route('mahasiswa.dashboard')
                ->with('success', 'Pendaftaran skripsi berhasil');
        } catch (\Throwable $e) {
            DB::rollback();
            return back()
                ->with('error', $e->getMessage());
        }
    }
}
