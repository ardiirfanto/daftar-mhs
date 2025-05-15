<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Mendapatkan role admin
        $adminRole = Role::where('name', 'admin')->first();

        // Membuat user admin
        User::create([
            'name' => 'Administrator',
            'role_id' => $adminRole->id,
            'email' => 'admin@example.com',
            'password' => Hash::make('admin'),
        ]);
    }
}
