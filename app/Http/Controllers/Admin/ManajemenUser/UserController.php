<?php

namespace App\Http\Controllers\Admin\ManajemenUser;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('role', 'user')->paginate(20);

        return view('admin.pages.manajemenuser.user', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'fakultas' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:8',
        ]);

        // Jika validasi gagal.
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        // Buat user baru dengan role 'user'
        User::create([
            'name' => $request->name,
            'fakultas' => $request->fakultas,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'user',
        ]);

        return redirect()->route('semua-user.index')->with('success', 'User berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $users = User::findOrFail($id);

        $validate = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'fakultas' => 'required',
            'email' => 'required|unique:users,email'. $users->id,
            'password' => 'required|min:8',
        ]);

        // Jika validasi gagal.
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        // Jika berhasil
        $data = [
            'name' => $request->name,
            'fakultas' => $request->fakultas,
            'email' => $request->email,
        ];

        // update password jika diisi
        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        };

        $users->update($data);

        return redirect()->back()->with('success', 'Data berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
