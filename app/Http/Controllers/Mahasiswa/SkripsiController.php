<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Services\DownloadServices;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SkripsiController extends Controller
{
    public function index()
    {

        $sessMahasiswa = Session::get('mahasiswa');
        $mahasiswa = Mahasiswa::with(['user', 'prodi.fakultas'])->find($sessMahasiswa->id); // Mengambil semua data mahasiswa
        $params = [
            'mahasiswa' => $mahasiswa,
        ];

        return view('mahasiswa.skripsi.index', $params);
    }

    public function downloadDetilSkripsi()
    {
        $downloadServices = new DownloadServices(Auth::user()); // Menggunakan dependency injection untuk mendapatkan objek user yang sedang login
        return $downloadServices->download();
    }
}
