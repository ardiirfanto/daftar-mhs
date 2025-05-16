<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\User;
use App\Services\DownloadServices;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

/**
 * Controller untuk manajemen data mahasiswa oleh admin.
 * Menangani tampilan daftar, detail, update status, hapus, dan unduh data mahasiswa.
 */
class MahasiswaController extends Controller
{
    /**
     * Menampilkan daftar seluruh mahasiswa.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $mahasiswa = Mahasiswa::with(['user', 'prodi.fakultas'])->get();
        $params = [
            'mahasiswa' => $mahasiswa,
        ];

        return view('admin.mahasiswa.index', $params);
    }

    /**
     * Menampilkan detail mahasiswa berdasarkan ID terenkripsi.
     *
     * @param string $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $id = decrypt($id);
        $mahasiswa = Mahasiswa::with(['user', 'prodi.fakultas'])
            ->find($id);
        $params = [
            'mahasiswa' => $mahasiswa,
        ];
        return view('admin.mahasiswa.show', $params);
    }

    /**
     * Memperbarui status skripsi mahasiswa.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $id = decrypt($request->id);
        $mahasiswa = Mahasiswa::find($id);
        if (!$mahasiswa) {
            return redirect()->back()->with('error', 'Mahasiswa tidak ditemukan.');
        }

        $mahasiswa->status_skripsi = $request->status_skripsi;
        if (isset($request->tanggal_sidang)) {
            $mahasiswa->tanggal_sidang = $request->tanggal_sidang;
        }
        $mahasiswa->save();
        return redirect()->back()->with('success', 'Status skripsi berhasil diperbarui.');
    }

    /**
     * Menghapus data mahasiswa beserta user terkait.
     *
     * @param string $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $id = decrypt($id);
            $mahasiswa = Mahasiswa::find($id);
            if (!$mahasiswa) {
                return redirect()->back()->with('error', 'Mahasiswa tidak ditemukan.');
            }
            $mahasiswa->delete();
            $user = User::find($mahasiswa->user_id);
            $user->delete();
            DB::commit();
            return redirect()->back()->with('success', 'Data mahasiswa berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data mahasiswa.');
        }
    }

    /**
     * Mengunduh daftar mahasiswa dalam format PDF.
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function downloadDaftarMahasiswa()
    {
        $downloadServices = new DownloadServices();
        return $downloadServices->download('admin');
    }
}
