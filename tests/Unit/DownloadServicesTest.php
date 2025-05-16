<?php

namespace Tests\Unit;

use App\Models\Fakultas;
use App\Models\Mahasiswa;
use App\Models\Prodi;
use App\Models\Role;
use App\Models\User;
use App\Services\DownloadServices;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class DownloadServicesTest extends TestCase
{
    use RefreshDatabase;

    protected Role $adminRole;
    protected Role $mahasiswaRole;
    protected User $adminUser;
    protected User $mahasiswaUser;
    protected Mahasiswa $mahasiswa;

    protected function setUp(): void
    {
        parent::setUp();
        $this->adminRole = Role::create(['name' => 'admin', 'description' => 'Admin Role']);
        $this->mahasiswaRole = Role::create(['name' => 'mahasiswa', 'description' => 'Mahasiswa Role']);
        Fakultas::create([
            'nama_fakultas' => 'Fakultas Test',
            'kode_fakultas' => 'FT',
            'deskripsi' => 'Fakultas Test',
        ]);
        $prodi = Prodi::create([
            'nama_prodi' => 'Prodi Test',
            'kode_prodi' => 'PT',
            'fakultas_id' => 1,
            'deskripsi' => 'Deskripsi Prodi',
        ]);
        $this->adminUser = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password123'),
            'role_id' => $this->adminRole->id,
        ]);
        $this->mahasiswaUser = User::create([
            'name' => 'Mahasiswa User',
            'email' => 'mahasiswa@example.com',
            'password' => bcrypt('password123'),
            'role_id' => $this->mahasiswaRole->id,
        ]);
        $this->mahasiswa = Mahasiswa::create([
            'user_id' => $this->mahasiswaUser->id,
            'nim' => '12345678',
            'prodi_id' => $prodi->id,
            'tahun_masuk' => '2023',
            'alamat' => 'Alamat',
            'no_hp' => '081234567890',
            'status' => 'aktif',
            'judul_skripsi' => 'Judul Skripsi',
            'dosen_pembimbing' => 'Dosen Pembimbing',
            'status_skripsi' => 'proposal',
            'tanggal_mulai_skripsi' => '2023-01-01',
        ]);
    }

    #[Test]
    public function downloadDaftarMahasiswaAsAdmin()
    {
        // Mock DomPDF facade dan method download
        $mockPdf = \Mockery::mock();
        $mockPdf->shouldReceive('setPaper')->andReturnSelf();
        $flag = false;
        $mockPdf->shouldReceive('download')->andReturn(
            $flag = true,
            response('', 200, ['content-disposition' => 'attachment; filename="daftarmhs.pdf"'])
        );
        $service = new DownloadServices();
        $service->download($this->adminUser);
        $this->assertEquals($flag, 1);
    }

    #[Test]
    public function downloadDetilMahasiswaAsMahasiswa()
    {
        // Mock DomPDF facade dan method download
        $mockPdf = \Mockery::mock();
        $mockPdf->shouldReceive('setPaper')->andReturnSelf();
        $flag = false;
        $mockPdf->shouldReceive('download')->andReturn(
            $flag = true,
            response('', 200, ['content-disposition' => 'attachment; filename="detilmhs_' . $this->mahasiswa->nim . '.pdf"'])
        );

        $service = new DownloadServices($this->mahasiswaUser);
        $service->download($this->mahasiswaUser);
        $this->assertEquals($flag, 1);
    }
}
