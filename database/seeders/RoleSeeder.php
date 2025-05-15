<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Membuat role admin dan mahasiswa
        Role::create([
            'name' => 'admin',
            'description' => 'Administrator Sistem',
        ]);

        Role::create([
            'name' => 'mahasiswa',
            'description' => 'Mahasiswa',
        ]);
    }
}
