<?php

namespace Database\Seeders;

use App\Models\Fasilitas;
use Illuminate\Database\Seeder;

class FasilitasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Fasilitas::create([
            'keterangan' => 'AC',
            'bobot' => 3,
        ]);

        Fasilitas::create([
            'keterangan' => 'WiFI',
            'bobot' => 4,
        ]);

        Fasilitas::create([
            'keterangan' => 'Kamar Mandi Dalam',
            'bobot' => 5,
        ]);

        Fasilitas::create([
            'keterangan' => 'Meja',
            'bobot' => 4,
        ]);

        Fasilitas::create([
            'keterangan' => 'Lemari',
            'bobot' => 3,
        ]);
    }
}
