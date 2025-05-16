<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;

/**
 * Controller untuk dashboard admin.
 * Menampilkan ringkasan data penting seperti jumlah mahasiswa.
 */
class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard admin dengan jumlah mahasiswa.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $jmlMhs = Mahasiswa::count();

        $params = [
            "jml_mhs" => $jmlMhs,
        ];

        return view('admin.dashboard', $params);
    }
}
