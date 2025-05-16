<?php

namespace Tests\Unit;

use App\Models\Fakultas;
use App\Models\Mahasiswa;
use App\Models\Prodi;
use App\Models\Role;
use App\Models\User;
use App\Services\AuthServices;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Session;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class AuthServicesTest extends TestCase
{
    use RefreshDatabase;

    protected AuthServices $authServices;
    protected User $user;
    protected Mahasiswa $mahasiswa;

    protected function setUp(): void
    {
        parent::setUp();
        $this->authServices = new AuthServices();
        $role = Role::create(['name' => 'mahasiswa', 'description' => 'Mahasiswa Role']);
        Fakultas::create([
            'nama_fakultas' => 'Fakultas Test',
            'kode_fakultas' => 'FT',
            'deskripsi' => 'Fakultas Test',
        ]);
        $this->user = User::create([
            'name' => 'Test User',
            'email' => 'testuser@example.com',
            'password' => bcrypt('password123'),
            'role_id' => $role->id,
        ]);
        $prodi = Prodi::create([
            'nama_prodi' => 'Prodi Test',
            'kode_prodi' => 'PT',
            'fakultas_id' => 1,
            'deskripsi' => 'Deskripsi Prodi',
        ]);
        $this->mahasiswa = Mahasiswa::create([
            'user_id' => $this->user->id,
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
    public function setUserShouldStoreUserInstance()
    {
        // Act
        $reflection = new \ReflectionClass($this->authServices);
        $method = $reflection->getMethod('setUser');
        $method->setAccessible(true);
        $method->invoke($this->authServices, $this->user);

        // Assert
        $property = $reflection->getProperty('user');
        $property->setAccessible(true);
        $this->assertEquals($this->user->id, $property->getValue($this->authServices)->id);
    }

    #[Test]
    public function setSessionMahasiswaShouldStoreMahasiswaInSession()
    {
        // Arrange
        $reflection = new \ReflectionClass($this->authServices);
        $setUser = $reflection->getMethod('setUser');
        $setUser->setAccessible(true);
        $setUser->invoke($this->authServices, $this->user);

        $setSession = $reflection->getMethod('setSessionMahasiswa');
        $setSession->setAccessible(true);
        $setSession->invoke($this->authServices);

        // Assert
        $mahasiswaSession = Session::get('mahasiswa');
        $this->assertNotNull($mahasiswaSession);
        $this->assertEquals($this->mahasiswa->id, $mahasiswaSession->id);
    }
}
