<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisKostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jenis = [
            ['name' => 'Putra'],
            ['name' => 'Putri'],
            ['name' => 'Campur'],
        ];

        DB::insert('jenis_kosts', $jenis);
    }
}
