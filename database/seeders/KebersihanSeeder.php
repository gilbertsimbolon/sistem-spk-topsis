<?php

namespace Database\Seeders;

use App\Models\Kebersihan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KebersihanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kebersihan::create([
            'keterangan' => 'Tempat Sampah di Setiap Kamar',
            'bobot' => 5,
        ]);

        Kebersihan::create([
            'keterangan' => 'Pembersih Kos',
            'bobot' => 5,
        ]);
    }
}
