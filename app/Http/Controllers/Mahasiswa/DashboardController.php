<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Controller untuk dashboard mahasiswa.
 * Menampilkan halaman utama dashboard mahasiswa.
 */
class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard mahasiswa.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('mahasiswa.dashboard');
    }
}
