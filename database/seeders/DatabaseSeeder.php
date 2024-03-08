<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\UnitSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\RuanganSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $this->call([
            RuanganSeeder::class,
            UnitSeeder::class,
            UserSeeder::class,
        ]);
    }
}
