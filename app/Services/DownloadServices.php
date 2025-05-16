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
     * User yang sedang aktif (admin atau mahasiswa).
     *
     * @var mixed
     */
    public $user;

    /**
     * Konstruktor DownloadServices.
     *
     * @param mixed $user Instance user yang sedang aktif.
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Menentukan jenis file PDF yang akan diunduh berdasarkan role user.
     * Jika admin, akan mengunduh daftar seluruh mahasiswa.
     * Jika mahasiswa, akan mengunduh detil data dirinya sendiri.
     *
     * @return \Illuminate\Http\Response File PDF yang siap diunduh.
     */
    public function download()
    {

        $role = $this->user->role->name;

        return match ($role) {
            'admin' => $this->downloadDaftarMahasiswa(),
            'mahasiswa' => $this->downloadDetilMahasiswa(),
            default => abort(403, 'Role kamu tidak memenuhi syarat'),
        };
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
    private function downloadDetilMahasiswa()
    {
        $mahasiswa = Mahasiswa::with(['user', 'prodi.fakultas'])
            ->find($this->user->mahasiswa->id); // Mengambil semua detil data mahasiswa
        $params = [
            'mahasiswa' => $mahasiswa,
        ];
        $pdf = Pdf::loadView('mahasiswa.download.detilmhs', $params)->setPaper('a4', 'potrait');
        return $pdf->download('detilmhs_' . $this->user->mahasiswa->nim . '.pdf');
    }
}
