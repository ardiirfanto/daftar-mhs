<?php

namespace Database\Seeders;

use App\Models\Fakultas;
use App\Models\Prodi;
use Illuminate\Database\Seeder;

class FakultasProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Membuat data fakultas
        $teknik = Fakultas::create([
            'nama_fakultas' => 'Fakultas Teknik',
            'kode_fakultas' => 'FT',
            'deskripsi' => 'Fakultas Teknik menyediakan pendidikan di bidang teknik dan teknologi.',
        ]);

        $ekonomi = Fakultas::create([
            'nama_fakultas' => 'Fakultas Ekonomi dan Bisnis',
            'kode_fakultas' => 'FEB',
            'deskripsi' => 'Fakultas Ekonomi dan Bisnis menyediakan pendidikan di bidang ekonomi, manajemen, dan akuntansi.',
        ]);

        $kedokteran = Fakultas::create([
            'nama_fakultas' => 'Fakultas Kedokteran',
            'kode_fakultas' => 'FK',
            'deskripsi' => 'Fakultas Kedokteran menyediakan pendidikan di bidang kedokteran dan kesehatan.',
        ]);

        // Membuat data prodi untuk Fakultas Teknik
        Prodi::create([
            'nama_prodi' => 'Teknik Informatika',
            'kode_prodi' => 'TI',
            'fakultas_id' => $teknik->id,
            'deskripsi' => 'Program studi yang mempelajari ilmu komputer dan pemrograman.',
        ]);

        Prodi::create([
            'nama_prodi' => 'Teknik Elektro',
            'kode_prodi' => 'TE',
            'fakultas_id' => $teknik->id,
            'deskripsi' => 'Program studi yang mempelajari ilmu elektro dan elektronika.',
        ]);

        Prodi::create([
            'nama_prodi' => 'Teknik Sipil',
            'kode_prodi' => 'TS',
            'fakultas_id' => $teknik->id,
            'deskripsi' => 'Program studi yang mempelajari ilmu konstruksi dan infrastruktur.',
        ]);

        // Membuat data prodi untuk Fakultas Ekonomi dan Bisnis
        Prodi::create([
            'nama_prodi' => 'Manajemen',
            'kode_prodi' => 'MN',
            'fakultas_id' => $ekonomi->id,
            'deskripsi' => 'Program studi yang mempelajari ilmu manajemen dan bisnis.',
        ]);

        Prodi::create([
            'nama_prodi' => 'Akuntansi',
            'kode_prodi' => 'AK',
            'fakultas_id' => $ekonomi->id,
            'deskripsi' => 'Program studi yang mempelajari ilmu akuntansi dan keuangan.',
        ]);

        // Membuat data prodi untuk Fakultas Kedokteran
        Prodi::create([
            'nama_prodi' => 'Pendidikan Dokter',
            'kode_prodi' => 'PD',
            'fakultas_id' => $kedokteran->id,
            'deskripsi' => 'Program studi yang mempelajari ilmu kedokteran umum.',
        ]);

        Prodi::create([
            'nama_prodi' => 'Keperawatan',
            'kode_prodi' => 'KP',
            'fakultas_id' => $kedokteran->id,
            'deskripsi' => 'Program studi yang mempelajari ilmu keperawatan.',
        ]);
    }
}
