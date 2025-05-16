<?php

namespace App\Services;

use App\Models\Mahasiswa;
use Barryvdh\DomPDF\Facade\Pdf;

/**
 * Kelas service untuk menangani proses download data mahasiswa dalam bentuk PDF.
 * Dapat digunakan oleh admin untuk mengunduh daftar seluruh mahasiswa,
 * maupun oleh mahasiswa untuk mengunduh detil data dirinya sendiri.
 */
class DownloadServices
{
    /**
     * Menentukan jenis file PDF yang akan diunduh berdasarkan role user.
     * Jika admin, akan mengunduh daftar seluruh mahasiswa.
     * Jika mahasiswa, akan mengunduh detil data dirinya sendiri.
     *
     * @return \Illuminate\Http\Response File PDF yang siap diunduh.
     */
    public function __call($name, $arguments)
    {
        if ($name == 'download') {
            $role = count($arguments) > 1 ? $arguments[0] : $arguments;
            $user = $arguments[1];
            return match ($role) {
                'admin' => $this->downloadDaftarMahasiswa(),
                'mahasiswa' => $this->downloadDetilMahasiswa($user),
                default => abort(403, 'Role kamu tidak memenuhi syarat'),
            };
        }

        return abort(403, 'Method tidak ditemukan');
    }

    /**
     * Meng-generate dan mengunduh PDF daftar seluruh mahasiswa (khusus admin).
     *
     * @return \Illuminate\Http\Response File PDF daftar mahasiswa.
     */
    private function downloadDaftarMahasiswa()
    {
        $mahasiswa = Mahasiswa::with(['user', 'prodi.fakultas'])->get(); // Mengambil semua data mahasiswa
        $params = [
            'mahasiswa' => $mahasiswa,
        ];
        $pdf = Pdf::loadView('admin.download.daftarmhs', $params)->setPaper('a4', 'landscape');;

        return $pdf->download('daftarmhs.pdf');
    }

    /**
     * Meng-generate dan mengunduh PDF detil data mahasiswa (khusus mahasiswa).
     *
     * @return \Illuminate\Http\Response File PDF detil mahasiswa.
     */
    private function downloadDetilMahasiswa($user)
    {
        $mahasiswa = Mahasiswa::with(['user', 'prodi.fakultas'])
            ->find($user->mahasiswa->id); // Mengambil semua detil data mahasiswa
        $params = [
            'mahasiswa' => $mahasiswa,
        ];
        $pdf = Pdf::loadView('mahasiswa.download.detilmhs', $params)->setPaper('a4', 'potrait');
        return $pdf->download('detilmhs_' . $user->mahasiswa->nim . '.pdf');
    }
}
