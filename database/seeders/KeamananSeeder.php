<?php

namespace Database\Seeders;

use App\Models\Keamanan;
use Illuminate\Database\Seeder;

class KeamananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Keamanan::create([
            'keterangan' => 'Satpam Berjaga 24 Jam',
            'bobot' => 5,
        ]);

        Keamanan::create([
            'keterangan' => 'CCTV',
            'bobot' => 5,
        ]);

        Keamanan::create([
            'keterangan' => 'Gerbang/Pagar',
            'bobot' => 5,
        ]);
    }
}
