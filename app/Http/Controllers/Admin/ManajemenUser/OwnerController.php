<?php

namespace App\Http\Controllers\Admin\ManajemenUser;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $owners = User::where('role', 'owner')->paginate(20);

        return view('admin.pages.manajemenuser.owner', compact('owners'));
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
            'email' => 'required|unique:users,email',
            'password' => 'required|min:8',
        ]);

        // jika validasi gagal
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        // buat user baru dengan role 'owner'
        User::create([
            'name' => $request->name,
            'fakultas' => null,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'owner',
        ]);

        return redirect()->route('owner.index')->with('success', 'Owner berhasil ditambahkan.');
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
        $owners = User::findOrFail($id);

        $validate = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|unique:users,email,' . $owners->id,
            'password' => 'nullable|min:8',
        ]);

        // jika validasi gagal
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        // jika berhasil
        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        // jika update password
        if($request->password) {
            $data['password'] = bcrypt($request->password);
        }

        $owners->update($data);

        return redirect()->back()->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $owners = User::findOrFail($id);
        $owners->delete();

        return redirect()->back()->with('success', 'Owner berhasil dihapus.');
    }
}
