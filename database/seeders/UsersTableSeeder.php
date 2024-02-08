<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Admin user
        User::create([
            'username' => 'administrator',
            'nama' => 'Admin User',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Regular user
        User::create([
            'username' => 'user',
            'nama' => 'Regular User',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        // Generate additional users using factory
        factory(User::class, 2)->create();
    }
}
