<?php

namespace App\Http\Controllers\Admin\ManajemenKost;

use App\Http\Controllers\Controller;
use App\Models\Kebersihan;
use Illuminate\Http\Request;

class KebersihanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kebersihan = Kebersihan::all();

        return view('admin.pages.manajemenkost.kebersihan', compact('kebersihan'));
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
        // validasi awal
        $request->validate([
            'keterangan' => 'required|string|max:255',
            'bobot' => 'required|integer|between:1,5',
        ]);

        Kebersihan::create([
            'keterangan' => $request->keterangan,
            'bobot' => $request->bobot,
        ]);

        return redirect()->route('kebersihan.index')->with('success', 'Kebersihan berhasil ditambahkan.');
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
            'keterangan' => 'required|string|max:255',
            'bobot' => 'required|integer|between:1,5',
        ]);

        $kebersihan = Kebersihan::findOrFail($id);

        $kebersihan->update([
            'keterangan' => $request->keterangan,
            'bobot' => $request->bobot,
        ]);

        return redirect()->route('kebersihan.index')->with('success', 'Kebersihan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kebersihan = Kebersihan::findOrFail($id);

        $kebersihan->delete();

        return redirect()->route('kebersihan.index')->with('success', 'Kebersihan berhasil diperbarui.');
    }
}
