<?php

namespace App\Http\Controllers\Admin\Topsis;

use App\Http\Controllers\Controller;
use App\Models\Criteria;
use Illuminate\Http\Request;

class CriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $criteria = Criteria::all();

        return view('admin.pages.topsis.data-kriteria', compact('criteria'));
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
            'kode_kriteria' => 'required|unique:criterias,kode_kriteria',
            'nama_kriteria' => 'required',
            'tipe' => 'required|in:benefit,cost',
            'bobot' => 'required|numeric|max:5',
        ]);

        if($request->bobot > 5) {
            return redirect()->back()->with('error', 'Bobot tidak boleh lebih dari 5.');
        }

        Criteria::create([
            'kode_kriteria' => $request->kode_kriteria,
            'nama_kriteria' => $request->nama_kriteria,
            'tipe' => $request->tipe,
            'bobot' => $request->bobot,
        ]);

        return redirect()->back()->with('success', 'Kriteria berhasil ditambahkan.');
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
            'kode_kriteria' => 'required|unique:criterias,kode_kriteria,' . $id,
            'nama_kriteria' => 'required',
            'tipe' => 'required|in:benefit,cost',
            'bobot' => 'required|numeric|max:5',
        ]);

        $criteria = Criteria::findOrFail($id);
        $criteria->update([
            'kode_kriteria' => $request->kode_kriteria,
            'nama_kriteria' => $request->nama_kriteria,
            'tipe' => $request->tipe,
            'bobot' => $request->bobot,
        ]);

        return redirect()->back()->with('success', 'Kriteria berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $criteria = Criteria::findOrFail($id);
        $criteria->delete();

        return redirect()->back()->with('success', 'Kriteria berhasil dihapus.');
    }
}
