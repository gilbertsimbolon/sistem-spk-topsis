<?php

namespace App\Http\Controllers\Admin\Topsis;

use App\Http\Controllers\Controller;
use App\Models\Criteria;
use App\Models\Fasilitas;
use App\Models\Keamanan;
use App\Models\Kebersihan;
use App\Models\Kost;
use App\Models\PenilaianAlternatif;
use App\Models\SubCriteria;
use Illuminate\Http\Request;

class PenilaianAlternatifController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // ambil data kost beserta relasi
        $kosts = Kost::with(['fasilitas', 'keamanan', 'kebersihan'])->get();

        // ambil semua sub kriteria
        $criterias = Criteria::with('subCriteria')->get();
        $totalKriteria = $criterias->count();

        // ambil total master data
        $totalMasterFasilitas = Fasilitas::count();
        $totalMasterKeamanan  = Keamanan::count();
        $totalMasterKebersihan = Kebersihan::count();

        // otomatisasi nilai
        foreach ($kosts as $kost) {
            $matriksKost = [];

            foreach ($criterias as $criteria) {
                $namaKriteriaClean = strtolower(trim($criteria->nama_kriteria));
                $nilaiRiil = 0;

                if (in_array($namaKriteriaClean, ['fasilitas', 'keamanan', 'kebersihan'])) {

                    // menghitung jumlah item yang dicentang untuk kriteria berbasis relasi
                    $jumlahDicentang = $kost->$namaKriteriaClean ? $kost->$namaKriteriaClean->count() : 0;

                    // hitung persentase
                    if ($namaKriteriaClean === 'fasilitas') {
                        $nilaiRiil = $totalMasterFasilitas > 0 ? ($jumlahDicentang / $totalMasterFasilitas) * 100 : 0;
                    } elseif ($namaKriteriaClean === 'keamanan') {
                        $nilaiRiil = $totalMasterKeamanan > 0 ? ($jumlahDicentang / $totalMasterKeamanan) * 100 : 0;
                    } else {
                        $nilaiRiil = $totalMasterKebersihan > 0 ? ($jumlahDicentang / $totalMasterKebersihan) * 100 : 0;
                    }

                }
                // untuk kriteria yang menggunakan angka biasa
                else {
                    $nilaiRiil = $kost->$namaKriteriaClean ?? 0;
                }

                // cari sub kriteria yang sesuai dengan nilai riil
                $sub = SubCriteria::where('criteria_id', $criteria->id)
                    ->where('nilai_minimum', '<=', $nilaiRiil)
                    ->where('nilai_maksimum', '>=', $nilaiRiil)
                    ->first();

                // simpan hasil
                $matriksKost[$criteria->id] = [
                    'bobot' => $sub ? $sub->nilai : 1,
                    'riil' => is_numeric($nilaiRiil) ? round($nilaiRiil, 0) : 0
                ];
            }

            $kost->matriks = $matriksKost;
        }

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

        return redirect()->back()->with('success', 'Sistem berjalan otomatis.');
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
