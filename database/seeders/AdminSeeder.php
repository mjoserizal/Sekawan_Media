<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create an admin user
        User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('123'),
            'role' => 'admin'
        ]);

        // Create an approval user
        User::create([
            'name' => 'approval',
            'email' => 'approval@approval.com',
            'password' => bcrypt('123'),
            'role' => 'approval'
        ]);
    }
}
