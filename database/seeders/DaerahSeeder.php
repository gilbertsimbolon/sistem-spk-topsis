<?php

namespace Database\Seeders;

use App\Models\DaerahKost;
use Illuminate\Database\Seeder;

class DaerahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DaerahKost::create([
            'name' => 'Tataaran Patar',
        ]);

        DaerahKost::create([
            'name' => 'Tataaran II',
        ]);

        DaerahKost::create([
            'name' => 'Tataaran I',
        ]);

        DaerahKost::create([
            'name' => 'Perum Blok A',
        ]);

        DaerahKost::create([
            'name' => 'Perum Blok B',
        ]);

        DaerahKost::create([
            'name' => 'Perum Blok C',
        ]);

        DaerahKost::create([
            'name' => 'Perum Blok D',
        ]);

        DaerahKost::create([
            'name' => 'Matani I',
        ]);
        
        DaerahKost::create([
            'name' => 'Matani II',
        ]);
    }
}
