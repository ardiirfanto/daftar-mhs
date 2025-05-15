<?php


namespace App\Services;

use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Session;

class AuthServices
{
    protected $user;

    protected function setUser($user){
        $this->user = $user;
    }

    protected function setSessionMahasiswa()
    {
        $mahasiswa = Mahasiswa::find($this->user->id);
        Session::put('mahasiswa', $mahasiswa);
    }
}
