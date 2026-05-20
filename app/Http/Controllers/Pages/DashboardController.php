<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Kost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //Fungsi Index
    public function index()
    {
        $user = Auth::user();

        return view('user.pages.dashboard', compact('user'));
    }

}
