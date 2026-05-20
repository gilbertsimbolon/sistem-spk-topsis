<?php

namespace App\Http\Controllers\Admin;

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
            'nama_fasilitas' => 'required|string:max:255',
        ]);

        Fasilitas::create([
            'nama_fasilitas' => $request->nama_fasilitas
        ]);

        return redirect()->route('fasilitas.index')->with('success', 'Fasilitas erhasil ditamahkan');
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
            'nama_fasilitas' => 'required|string|max:255',
        ]);

        $fasilitas = Fasilitas::findOrFail($id);

        $fasilitas->update([
            'nama_fasilitas' => $request->nama_fasilitas
        ]);

        return redirect()->route('fasilitas.index')->with('success', 'Fasilitas erhasil diperarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $fasilitas = Fasilitas::findOrFail($id);

        $fasilitas->delete();

        return redirect()->route('fasilitas.index')->with('success', 'Fasilitas erhasil dihapus.');
    }
}
