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
        // cek kriteria utama
        $kriteriaUtama = Criteria::findOrFail($request->criteria_id);
        $namaKriteriaIdn = strtolower(trim($kriteriaUtama->nama_kriteria));

        $ruleMinimum = 'required|integer|min:0';
        $ruleMaksimum = 'required|integer|gte:nilai_minimum';

        // jika kriteria berbasis persen
        if (in_array($namaKriteriaIdn, ['fasilitas', 'keamanan', 'kebersihan'])) {
            $ruleMinimum = 'required|integer|between:0,100';
            $ruleMaksimum = 'required|integer|between:0,100|gte:nilai_minimum';
        }

        // validasi
        $request->validate([
            'criteria_id'   => 'required|exists:criterias,id',
            'nilai_minimum' => $ruleMinimum,
            'nilai_maksimum' => $ruleMaksimum,
            'keterangan'    => 'required|string|max:255',
            'nilai'         => 'required|numeric|between:1,5',
        ]);

        // simpan data
        SubCriteria::create([
            'criteria_id'   => $request->criteria_id,
            'nilai_minimum' => $request->nilai_minimum,
            'nilai_maksimum' => $request->nilai_maksimum,
            'keterangan'    => $request->keterangan,
            'nilai'         => $request->nilai,
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
        // cek kriteria untuk validasi edit
        $kriteriaUtama = Criteria::findOrFail($request->criteria_id);
        $namaKriteriaIdn = strtolower(trim($kriteriaUtama->nama_kriteria));

        $ruleMinimum = 'required|integer|min:0';
        $ruleMaksimum = 'required|integer|gte:nilai_minimum';

        if (in_array($namaKriteriaIdn, ['fasilitas', 'keamanan', 'kebersihan'])) {
            $ruleMinimum = 'required|integer|between:0,100';
            $ruleMaksimum = 'required|integer|between:0,100|gte:nilai_minimum';
        }

        // validasi update
        $request->validate([
            'criteria_id'   => 'required|exists:criterias,id',
            'nilai_minimum' => $ruleMinimum,
            'nilai_maksimum' => $ruleMaksimum,
            'keterangan'    => 'required|string|max:255',
            'nilai'         => 'required|numeric|between:1,5',
        ]);

        // cari dan update data
        $subCriteria = SubCriteria::findOrFail($id);
        $subCriteria->update([
            'criteria_id'   => $request->criteria_id,
            'nilai_minimum' => $request->nilai_minimum,
            'nilai_maksimum' => $request->nilai_maksimum,
            'keterangan'    => $request->keterangan,
            'nilai'         => $request->nilai,
        ]);

        return redirect()->back()->with('with', 'Sub kriteria berhasil diperbarui.');
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
