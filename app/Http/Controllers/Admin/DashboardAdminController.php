<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kost;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardAdminController extends Controller
{
    public function index()
    {
        // Menghitung metrik statistik untuk Dashboard
        $totalKost = Kost::count();
        $totalOwner = User::where('role', 'owner')->count();
        $totalUser = User::where('role', 'user')->count();
        $rataHarga = Kost::avg('harga') ?? 0;

        return view('admin.pages.dashboard', compact(
            'totalKost', 'totalOwner', 'totalUser', 'rataHarga'
        ));
    }
}
