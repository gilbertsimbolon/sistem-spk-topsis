<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    // Menampilkan halaman form profil
    public function edit()
    {
        return view('admin.profile.edit');
    }

    // Mengupdate data Nama & Email
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return back()->with('success', 'Profil berhasil diperbarui!');
    }

    // Mengupdate Password
    public function password(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'], // Validasi otomatis mengecek password lama
            'password' => ['required', 'string', 'min:8', 'confirmed'], // Wajib ada password_confirmation
        ]);

        Auth::user()->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'Password berhasil diubah!');
    }
}
