<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    // Fungsi Index
    public function index()
    {
        return view('auth.login');
    }

    // Fungsi Login
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $credentials = $request->only('email', 'password');

        if(Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // pengecekan role
            if ($user->role === 'admin') { // jika role admin, maka akan dilempar ke halaman dashboard admin
                return redirect()->route('admin.dashboard.index');
            } elseif ($user->role === 'owner') {
                return redirect()->route('owner.data-kost.index');
            } else {
                return redirect()->route('dashboard.index');
            }

        }

        return back()->withErrors([
            'email' => 'Email atau password salah'
        ])->withInput();
    }

    // Fungsi Logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('index');
    }
}
