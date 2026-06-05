<?php

namespace App\Http\Controllers\Admin\ManajemenKost;

use App\Http\Controllers\Controller;
use App\Models\Fasilitas;
use Illuminate\Http\Request;

class FasilitasKostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fasilitas = Fasilitas::all();

        return view('admin.pages.manajemenkost.fasilitas-kost', compact('fasilitas'));
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
        $request->validate([
            'keterangan' => 'required|string:max:255',
            'bobot' => 'required|integer|between:1,5',
        ]);

        Fasilitas::create([
            'keterangan' => $request->keterangan,
            'bobot' => $request->bobot,
        ]);

        return redirect()->route('fasilitas.index')->with('success', 'Fasilitas berhasil ditambahkan');
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

        $fasilitas = Fasilitas::findOrFail($id);

        $fasilitas->update([
            'keterangan' => $request->keterangan,
            'bobot' => $request->bobot,
        ]);

        return redirect()->route('fasilitas.index')->with('success', 'Fasilitas berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $fasilitas = Fasilitas::findOrFail($id);

        $fasilitas->delete();

        return redirect()->route('fasilitas.index')->with('success', 'Fasilitas berhasil dihapus.');
    }
}
