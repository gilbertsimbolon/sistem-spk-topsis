<?php

namespace App\Http\Controllers\Admin\ManajemenKost;

use App\Http\Controllers\Controller;
use App\Models\Keamanan;
use Illuminate\Http\Request;

class KeamananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $keamanan = Keamanan::all();

        return view('admin.pages.manajemenkost.keamanan', compact('keamanan'));
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
        // validasi
        $request->validate([
            'keterangan' => 'required|string|max:255',
            'bobot' => 'required|integer|between:1,5',
        ]);

        Keamanan::create([
            'keterangan' => $request->keterangan,
            'bobot' => $request->bobot,
        ]);

        return redirect()->route('keamanan.index')->with('success', 'Keamanan berhasil ditambahkan.');
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
        $request->validate([
            'keterangan' => 'required|string:max:255',
            'bobot' => 'required|integer|between:1,5',
        ]);

        $keamanan = Keamanan::findOrFail($id);

        $keamanan->update([
            'keterangan' => $request->keterangan,
            'bobot' => $request->bobot,
        ]);

        return redirect()->route('keamanan.index')->with('success', 'Keamanan berhasil ditambahkan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $keamanan = Keamanan::findOrFail($id);

        $keamanan->delete();

        return redirect()->route('keamanan.index')->with('success', 'Keamanan berhasil dihapus.');
    }
}
