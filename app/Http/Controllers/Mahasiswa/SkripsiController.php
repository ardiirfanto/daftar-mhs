<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Services\DownloadServices;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

/**
 * Controller untuk fitur skripsi mahasiswa.
 * Menangani tampilan data skripsi dan unduh detil skripsi dalam format PDF.
 */
class SkripsiController extends Controller
{
    /**
     * Menampilkan halaman data skripsi mahasiswa.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $sessMahasiswa = Session::get('mahasiswa');
        $mahasiswa = Mahasiswa::with(['user', 'prodi.fakultas'])->find($sessMahasiswa->id);
        $params = [
            'mahasiswa' => $mahasiswa,
        ];
        return view('mahasiswa.skripsi.index', $params);
    }

    /**
     * Mengunduh detil data skripsi mahasiswa dalam format PDF.
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function downloadDetilSkripsi()
    {
        $downloadServices = new DownloadServices(Auth::user());
        return $downloadServices->download();
    }
}
