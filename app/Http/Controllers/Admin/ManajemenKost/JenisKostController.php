<?php

namespace App\Http\Controllers\Admin\ManajemenKost;

use App\Http\Controllers\Controller;
use App\Models\JenisKost;
use Illuminate\Http\Request;

class JenisKostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jenis = JenisKost::all();

        return view('admin.pages.manajemenkost.jenis-kost', compact('jenis'));
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
            'jenis_kost' => 'required|string|max:255'
        ]);

        JenisKost::create([
            'jenis_kost' => $request->jenis_kost
        ]);

        return redirect()->route('jenis-kost.index')->with('success', 'Jenis Kost erhasil ditamahkan');
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
            'jenis_kost' => 'required|string|max:255'
        ]);

        $jenis = JenisKost::findOrFail($id);

        $jenis->update([
            'jenis_kost' => $request->jenis_kost
        ]);

        return redirect()->route('jenis-kost.index')->with('success', 'Jenis kost erhasil diperarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jenis = JenisKost::findOrFail($id);
        $jenis->delete();

        return redirect()->route('jenis-kost.index')->with('success', 'Jenis kost erhasil dihapus');
    }
}
