<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DaerahKost;
use App\Models\Fasilitas;
use App\Models\FotoKost;
use App\Models\JenisKost;
use App\Models\Keamanan;
use App\Models\Kebersihan;
use App\Models\Kost;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    // get data kost
    public function kost()
    {
        $kosts = Kost::with(['jenis', 'fasilitas', 'keamanan', 'kebersihan', 'foto', 'daerah'])->get();

        $jenis = JenisKost::all();
        $daerah = DaerahKost::all();
        $fasilitas = Fasilitas::all();
        $keamanan = Keamanan::all();
        $kebersihan = Kebersihan::all();
        $foto = FotoKost::all();

        return view('index', compact('kosts', 'jenis', 'daerah', 'fasilitas', 'keamanan', 'kebersihan', 'foto'));
    }
}
