<?php

namespace App\Http\Controllers\Admin\Laporan;

use App\Http\Controllers\Controller;
use App\Models\Kost;
use App\Models\User;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function dataKost()
    {
        // Ambil semua data kost beserta relasinya
        $kosts = Kost::with(['jenis', 'daerah'])->get();

        return view('admin.pages.laporan.data-kost', compact('kosts'));
    }
}
