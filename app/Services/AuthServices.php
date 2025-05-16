<?php

namespace App\Services;

use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Session;

/**
 * Kelas dasar untuk layanan autentikasi.
 * Menyediakan fungsi untuk menyimpan user dan sesi mahasiswa.
 */
class AuthServices
{
    /**
     * Menyimpan instance user yang sedang aktif.
     *
     * @var mixed
     */
    protected $user;

    /**
     * Mengatur user yang sedang aktif.
     *
     * @param mixed $user Instance user yang akan disimpan.
     * @return void
     */
    protected function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * Menyimpan data mahasiswa ke dalam sesi berdasarkan user yang aktif.
     *
     * @return void
     */
    protected function setSessionMahasiswa()
    {
        $mahasiswa = Mahasiswa::where('user_id', $this->user->id)->first();
        Session::put('mahasiswa', $mahasiswa);
    }
}
