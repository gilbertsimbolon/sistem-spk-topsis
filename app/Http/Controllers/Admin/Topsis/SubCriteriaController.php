<?php

namespace App\Http\Controllers\Admin\Topsis;

use App\Http\Controllers\Controller;
use App\Models\Criteria;
use App\Models\Fasilitas;
use App\Models\SubCriteria;
use Illuminate\Http\Request;

class SubCriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subCriterias = SubCriteria::with('criteria')->get();

        // mengambil semua data criteria
        $criterias = Criteria::all();
        $fasilitas = Fasilitas::all();

        return view('admin.pages.topsis.data-sub-kriteria', compact('subCriterias', 'criterias', 'fasilitas'));
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
            'criteria_id' => 'required|exists:criterias,id',
            'nilai'       => 'required|numeric',
        ]);

        // cek kriteria yang dipilih oleh admin
        $kriteriaUtama = \App\Models\Criteria::find($request->criteria_id);

        // logika penentuan nama kriteria
        if (strtolower($kriteriaUtama->nama_kriteria) === 'fasilitas') {
            // jika kriteria fasilitas
            $request->validate([
                'nama_sub_kriteria_fasilitas' => 'required|string|max:255',
            ]);
            $namaSubKriteria = $request->nama_sub_kriteria_fasilitas;
        } else {
            // jika kriteria selain fasilitas
            $request->validate([
                'nama_sub_kriteria_manual' => 'required|string|max:255',
            ]);
            $namaSubKriteria = $request->nama_sub_kriteria_manual;
        }

        // membuat sub criteria
        SubCriteria::create([
            'criteria_id'       => $request->criteria_id,
            'nama_sub_kriteria' => $namaSubKriteria, 
            'nilai'             => $request->nilai,
        ]);

        return redirect()->back()->with('success', 'Sub kriteria berhasil ditambahkan.');
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
            'criteria_id' => 'required|exists:criterias,id',
            'nama_sub_kriteria' => 'required|string|max:255',
            'nilai' => 'required|numeric',
        ]);

        $subCriteria = SubCriteria::findOrFail($id);
        $subCriteria->update([
            'criteria_id' => $request->criteria_id,
            'nama_sub_kriteria' => $request->nama_sub_kriteria,
            'nilai' => $request->nilai,
        ]);

        return redirect()->back()->with('success', 'Sub kriteria berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subCriteria = SubCriteria::findOrFail($id);
        $subCriteria->delete();

        return redirect()->back()->with('success', 'Sub kriteria berhasil dihapus.');
    }
}
