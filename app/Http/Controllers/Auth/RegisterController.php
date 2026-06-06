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
        // dd($request->all());

        // Validasi Data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|unique:users,email',
            'nomor' => 'required|numeric|digits_between:10,15',
            'fakultas' => 'required|in:fatek,fish,feb,fikkm,fbs,fipp,fke',
            'password' => 'required|min:8',
        ], [
            'email.unique' => 'Email ini sudah terdaftar!',
            'email.email' => 'Format email tidak valid!',
            'password.min' => 'Password minimal harus 8 karakter!',
        ]);

        // Jika validasi gagal.
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Jika validasi berhasil, maka buat akun
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'nomor' => $request->nomor,
            'fakultas' => $request->fakultas,
            'password' => Hash::make($request->password),
            'role' => 'user',
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil!');
    }
}
