<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComingSoonController extends Controller
{
    // Fungsi Index
    public function index()
    {
        $user = Auth::user();

        return view('user.pages.coming-soon', [
            'fullname' => trim($user->firstname ?? 'Wilson') . ' ' . ($user->lastname ?? 'Siahaan'),
        ]);
    }
}
