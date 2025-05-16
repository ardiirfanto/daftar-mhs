<?php

namespace Tests\Unit;

use App\Models\Role;
use App\Models\User;
use App\Services\AdminServices;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\RedirectResponse;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class AdminServicesTest extends TestCase
{
    use RefreshDatabase;

    protected AdminServices $adminServices;
    protected Role $adminRole;

    protected function setUp(): void
    {
        parent::setUp();
        $this->adminServices = new AdminServices();
        $this->adminRole = Role::create([
            'name' => 'admin',
            'description' => 'Admin Role'
        ]);
    }

    #[Test]
    public function loginAdmin()
    {
        // Arrange
        $user = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password123'),
            'role_id' => $this->adminRole->id,
        ]);

        // Act
        $response = $this->adminServices->login($user);

        // Assert
        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals(route('admin.dashboard'), $response->headers->get('Location'));
        $this->assertEquals('Anda Berhasil Login sebagai Administrator', session('success'));
    }
}
