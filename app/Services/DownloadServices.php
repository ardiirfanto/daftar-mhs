<?php

namespace App\Services;

use App\Models\Mahasiswa;
use Barryvdh\DomPDF\Facade\Pdf;

class DownloadServices
{

    public $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function download()
    {

        $role = $this->user->role->name;

        return match ($role) {
            'admin' => $this->downloadDaftarMahasiswa(),
            'mahasiswa' => $this->downloadDetilMahasiswa(),
            default => abort(403, 'Role kamu tidak memenuhi syarat'),
        };
    }

    private function downloadDaftarMahasiswa()
    {
        $mahasiswa = Mahasiswa::with(['user', 'prodi.fakultas'])->get(); // Mengambil semua data mahasiswa
        $params = [
            'mahasiswa' => $mahasiswa,
        ];
        $pdf = Pdf::loadView('admin.download.daftarmhs', $params)->setPaper('a4', 'landscape');;

        return $pdf->download('daftarmhs.pdf');
    }

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
