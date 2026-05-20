<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Kost;
use Illuminate\Http\Request;

class KostController extends Controller
{
    public function index()
    {
        $data = Kost::all()->get(10);

        return view('user.pages.dashboard', compact($data));
    }
}
