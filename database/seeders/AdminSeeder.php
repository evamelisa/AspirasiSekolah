<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            // Data Admin
            [
                'name' => 'Eva Melisa',
                'username' => 'evamelisa',
                'password' => 'admin123',
                'role' => 'admin',
            ],
        ];
    }
}