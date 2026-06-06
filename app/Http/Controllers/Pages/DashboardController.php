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

        $query = Kost::with(['jenis', 'fasilitas', 'keamanan', 'kebersihan', 'foto', 'daerah']);
        
        // Filter Daerah
        if ($request->filled('daerah_kost_id')) {
            $query->where('daerah_kost_id', $request->daerah_kost_id);
        }

        // Filter Jenis Kost (Mengambil ID dari DB)
        if ($request->filled('tipe_kost')) {
            $query->where('jenis_kost_id', $request->tipe_kost); 
        }

        // Filter Rentang Harga Minimal
        if ($request->filled('harga_minimal')) {
            $query->where('harga', '>=', $request->harga_minimal);
        }

        // Filter Rentang Harga Maksimal
        if ($request->filled('harga_maksimal')) {
            $query->where('harga', '<=', $request->harga_maksimal);
        }

        // Filter Fasilitas Kamar
        if ($request->has('fasilitas') && is_array($request->fasilitas)) {
            $query->whereHas('fasilitas', function($q) use ($request) {
                $q->whereIn('fasilitas.id', $request->fasilitas); 
            });
        }

        // Filter Sistem Keamanan
        if ($request->has('keamanan') && is_array($request->keamanan)) {
            $query->whereHas('keamanan', function($q) use ($request) {
                $q->whereIn('keamanan.id', $request->keamanan);
            });
        }

        // Filter Kebersihan
        if ($request->has('kebersihan') && is_array($request->kebersihan)) {
            $query->whereHas('kebersihan', function($q) use ($request) {
                $q->whereIn('kebersihan.id', $request->kebersihan);
            });
        }

        $kosts = $query->paginate(8)->appends($request->query());

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
