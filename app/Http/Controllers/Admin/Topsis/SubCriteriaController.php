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
            'nilai_minimum' => 'nullable|integer|min:0',
            'nilai_maksimum' => 'nullable|integer|gte:nilai_minimum',
            'nilai'       => 'required|numeric|between:1,5',
        ]);

        // cek kriteria yang dipilih oleh admin
        $kriteriaUtama = Criteria::findOrFail($request->criteria_id);
        $namaKriteriaIdn = strToLower($kriteriaUtama->nama_kriteria);
        $keteranganSub = '';

        // penentuan teks keterangan berdasarkan jenis kriteria
        if ($namaKriteriaIdn === 'fasilitas') {
            $request->validate([
                'nama_sub_kriteria_fasilitas' => 'required|string|max:255',
            ]);
            $keteranganSub = $request->nama_sub_kriteria_fasilitas;
        } else {
            $request->validate([
                'nama_sub_kriteria_manual' => 'required|string|max:255',
            ]);
            $keteranganSub = $request->nama_sub_kriteria_manual;
        }

        // membuat sub criteria setelah berhasil melakukan validasi
        SubCriteria::create([
            'criteria_id' => $request->criteria_id,
            'nilai_minimum' => $request->nilai_minimum,
            'nilai_maksimum' => $request->nilai_maksimum,
            'keterangan' => $keteranganSub,
            'nilai' => $request->nilai,
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
        // validasi awal
        $request->validate([
            'criteria_id' => 'required|exists:criterias,id',
            'nilai_minimum' => 'nullable|integer|min:0',
            'nilai_maksimum' => 'nullable|integer|gte:nilai_minimum',
            'keterangan' => 'required|string|max:255',
            'nilai' => 'required|numeric|between:1,5',
        ]);

        // cari sub kriteria yang indin diedit berdasarkan id
        $subCriteria = SubCriteria::findOrFail($id);

        // update data
        $subCriteria->update([
            'criteria_id' => $request->criteria_id,
            'nilai_minimum' => $request->nilai_minimum,
            'nilai_maksimum' => $request->nilai_maksimum,
            'keterangan' => $request->keterangan,
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
