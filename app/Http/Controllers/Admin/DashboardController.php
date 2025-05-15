<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {

        $jmlMhs = Mahasiswa::count();

        $params = [
            "jml_mhs" => $jmlMhs,
        ];

        return view('admin.dashboard', $params);
    }
}
