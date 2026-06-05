<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(AdminSeeder::class);
        $this->call(JenisKostSeeder::class);
        $this->call(FasilitasSeeder::class);
        $this->call(KeamananSeeder::class);
        $this->call(KebersihanSeeder::class);
        $this->call(DaerahSeeder::class);
    }
}
