<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswa = Mahasiswa::with(['user', 'prodi.fakultas'])->get(); // Mengambil semua data mahasiswa
        $params = [
            'mahasiswa' => $mahasiswa,
        ];

        return view('admin.mahasiswa.index', $params);
    }

    public function show($id)
    {

        $id = decrypt($id);

        $mahasiswa = Mahasiswa::with(['user', 'prodi.fakultas'])
            ->find($id); // Mengambil semua detil mahasiswa

        $params = [
            'mahasiswa' => $mahasiswa,
        ];
        return view('admin.mahasiswa.show', $params);
    }

    public function update(Request $request)
    {
        $id = decrypt($request->id);
        $mahasiswa = Mahasiswa::find($id);
        if (!$mahasiswa) {
            return redirect()->back()->with('error', 'Mahasiswa tidak ditemukan.');
        }

        $mahasiswa->status_skripsi = $request->status_skripsi;
        if(isset($request->tanggal_sidang)){
            $mahasiswa->tanggal_sidang = $request->tanggal_sidang;
        }
        $mahasiswa->save();
        return redirect()->back()->with('success', 'Status skripsi berhasil diperbarui.');
    }
}
