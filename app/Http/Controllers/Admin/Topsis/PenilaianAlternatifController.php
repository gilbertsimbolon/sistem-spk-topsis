<?php

namespace App\Http\Controllers\Admin\Topsis;

use App\Http\Controllers\Controller;
use App\Models\Criteria;
use App\Models\Kost;
use App\Models\PenilaianAlternatif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenilaianAlternatifController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // ambil kost dengan relasi ke penilaian alternatif
        $kosts = Kost::with('penilaianAlternatifs')->get();
        
        // ambil kriteria 
        $criterias = Criteria::whereNotIn(DB::raw('LOWER(nama_kriteria)'), ['harga', 'fasilitas'])
                             ->with('subCriteria')
                             ->get();
        
        // 3. Total kriteria yang harus dinilai manual (untuk indikator badge lengkap/tidak)
        $totalKriteria = $criterias->count();

        return view('admin.pages.topsis.penilaian-alternatif', compact('kosts', 'criterias', 'totalKriteria'));
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
            'kost_id' => 'required|exists:kosts,id',
            'nilai' => 'required|array',
        ]);

        foreach ($request->nilai as $criteriaId => $nilaiAngka) {
            // Jika nilai tidak diisi, abaikan atau beri 0
            if ($nilaiAngka === null) continue;

            PenilaianAlternatif::updateOrCreate(
                [
                    'kost_id' => $request->kost_id,
                    'criteria_id' => $criteriaId
                ],
                [
                    'nilai' => $nilaiAngka
                ]
            );
        }

        return redirect()->back()->with('success', 'Penilaian berhasil disimpan!');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
