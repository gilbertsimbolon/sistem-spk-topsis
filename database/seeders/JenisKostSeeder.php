<?php

namespace Database\Seeders;

use App\Models\JenisKost;
use Illuminate\Database\Seeder;

class JenisKostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JenisKost::create([
            'jenis_kost' => 'Putra',
        ]);

        JenisKost::create([
            'jenis_kost' => 'Putri',
        ]);

        JenisKost::create([
            'jenis_kost' => 'Campur',
        ]);
    }
}
