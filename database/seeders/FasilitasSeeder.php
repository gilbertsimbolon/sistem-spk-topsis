<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FasilitasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fasilitas = [
            ['name' => 'AC'],
            ['name'=> 'CCTV'],
            ['name' => 'TV'],
            ['name' => 'Kamar Mandi Dalam'],
            ['name' => 'Kamar Mandi Luar'],
            ['name' => 'Kasur'],
            ['name' => 'KOI'],
            ['name' => 'Wi-Fi'],
            ['name' => 'Kulkas'],
            ['name' => 'Meja'],
            ['name' => 'Kursi'],
            ['name' => 'Air'],
            ['name' => 'Listrik'],
        ];

        DB::insert('fasilitas', $fasilitas);
    }
}
