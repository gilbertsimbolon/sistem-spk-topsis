<?php

namespace App\Http\Controllers\Admin\ManajemenKost;

use App\Http\Controllers\Controller;
use App\Models\DaerahKost;
use Illuminate\Http\Request;

class DaerahKostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $daerah = DaerahKost::all();

        return view('admin.pages.manajemenkost.daerah', compact('daerah'));
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
            'name' = 'required|string|max:255'
        ]);

        DaerahKost::create([
            'name' => $request->name,
        ]);

        return redirect()->route('daerah.index')->with('success', 'Daerah berhasil ditambahkan');
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
            'name' => 'required|string|max:255'
        ]);

        $daerah = DaerahKost::findOrFail($id);

        $daerah->update([
            'name' => $request->name,
        ]);

        return redirect()->route('daerah.index')->with('success', 'Daerah kost berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $daerah = DaerahKost::findOrFail($id);

        $daerah->delete();

        return redirect()->route('daerah.index')->with('success', 'Daerah kost berhasil dihapus.');
    }
}
