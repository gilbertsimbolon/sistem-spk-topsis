<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\DaerahKost;
use App\Models\Fasilitas;
use App\Models\FotoKost;
use App\Models\JenisKost;
use App\Models\Keamanan;
use App\Models\Kebersihan;
use App\Models\Kost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //Fungsi Index
    public function index(Request $request)
    {
        $user = Auth::user();

        $kosts = Kost::with(['jenis', 'fasilitas', 'keamanan', 'kebersihan', 'foto', 'daerah'])->paginate(8);

        if ($request->ajax()) {
            return view('partials.kost_list', compact('kosts'))->render();
        }

        $jenis = JenisKost::all();
        $daerah = DaerahKost::all();
        $fasilitas = Fasilitas::all();
        $keamanan = Keamanan::all();
        $kebersihan = Kebersihan::all();
        $foto = FotoKost::all();

        return view('user.pages.dashboard', compact('kosts', 'jenis', 'daerah', 'fasilitas', 'keamanan', 'kebersihan', 'foto', 'user'));
    }

    public function show(string $id)
    {
        // Mengambil data kost tunggal beserta seluruh relasinya
        $kost = Kost::with(['jenis', 'fasilitas', 'keamanan', 'kebersihan', 'foto', 'daerah', 'owner'])->findOrFail($id);

        // Return ke halaman view khusus user yang baru saja dibuat
        return view('user.pages.detail-kost', compact('kost'));
    }
}
