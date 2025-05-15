<?php

namespace Tests\Unit;

use App\Models\Fakultas;
use App\Models\Prodi;
use App\Models\Role;
use App\Services\MahasiswaServices;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class MahasiswaServicesTest extends TestCase
{
    use RefreshDatabase;

    protected MahasiswaServices $mahasiswaServices;
    protected Role $mahasiswaRole;
    protected Prodi $prodi;

    protected function setUp(): void
    {
        parent::setUp();
        // Membuat instance MahasiswaServices
        $this->mahasiswaServices = new MahasiswaServices();

        // Membuat role mahasiswa
        $this->mahasiswaRole = Role::create([
            'name' => 'mahasiswa',
            'description' => 'Mahasiswa Role'
        ]);

        // Membuat fakultas untuk testing
        Fakultas::create([
            'nama_fakultas' => 'Fakultas Test',
            'kode_fakultas' => 'FT',
            'deskripsi' => 'Fakultas Test menyediakan pendidikan di bidang kedokteran dan kesehatan.',
        ]);

        // Membuat prodi untuk testing
        $this->prodi = Prodi::create([
            'nama_prodi' => 'Prodi Test',
            'kode_prodi' => 'PT',
            'fakultas_id' => 1,
            'deskripsi' => 'Program studi yang mempelajari ilmu kedokteran umum.',
        ]);
    }

    #[Test]
    public function registerMahasiswa()
    {
        // Arrange
        $request = new Request([
            'name' => 'Test Student',
            'email' => 'student@example.com',
            'password' => 'password123',
            'nim' => '12345678',
            'prodi_id' => $this->prodi->id,
            'tahun_masuk' => '2023',
            'alamat' => 'Test Address',
            'no_hp' => '081234567890',
            'judul_skripsi' => 'Test Skripsi',
            'dosen_pembimbing' => 'Dr. Test',
            'status_skripsi' => 'proposal',
            'tanggal_mulai_skripsi' => '2023-01-01'
        ]);

        // Act
        $response = $this->mahasiswaServices->register($request);

        // Assert
        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals(route('mahasiswa.dashboard'), $response->headers->get('Location'));

        // Verify user was created
        $this->assertDatabaseHas('users', [
            'name' => 'Test Student',
            'email' => 'student@example.com',
            'role_id' => $this->mahasiswaRole->id
        ]);

        // Verify mahasiswa was created
        $this->assertDatabaseHas('mahasiswa', [
            'nim' => '12345678',
            'prodi_id' => $this->prodi->id,
            'tahun_masuk' => '2023',
            'alamat' => 'Test Address',
            'no_hp' => '081234567890',
            'judul_skripsi' => 'Test Skripsi',
            'dosen_pembimbing' => 'Dr. Test',
            'status_skripsi' => 'proposal'
        ]);
    }
}
