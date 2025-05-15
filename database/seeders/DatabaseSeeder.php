<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Menjalankan seeders
        $this->call([
            RoleSeeder::class,
            FakultasProdiSeeder::class,
            AdminUserSeeder::class,
        ]);
    }
}
