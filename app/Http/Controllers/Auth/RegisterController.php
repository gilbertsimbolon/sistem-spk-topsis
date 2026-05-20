<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    // Fungsi Index
    public function index()
    {
        return view('auth.register');
    }

    // Fungsi Register
    public function create(Request $request)
    {
        // Validasi Data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|unique:users,email',
            'fakultas' => 'required|in:fatek,fish,feb,fikkm,fbs,fipp,fke',
            'password' => 'required|min:8',
        ]);

        // Jika validasi gagal.
        if($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Jika validasi berhasil, maka buat akun
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'fakultas' => $request->fakultas,
            'password' => Hash::make($request->password),
            'role' => 'user',
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil!');
    }
}
