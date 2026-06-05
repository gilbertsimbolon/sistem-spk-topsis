<?php

namespace App\Http\Controllers\Admin\Topsis;

use App\Http\Controllers\Controller;
use App\Models\Criteria;
use App\Models\Fasilitas;
use App\Models\Keamanan;
use App\Models\Kebersihan;
use App\Models\Kost;
use App\Models\SubCriteria;

class TopsisController extends Controller
{
    public function hitung()
    {
        // ambil data kost beserta relasi
        $kosts = Kost::with(['fasilitas', 'keamanan', 'kebersihan'])->get();
        $criterias = Criteria::with('subCriteria')->get();

        // ambil master data pembagi
        $totalMasterFasilitas = Fasilitas::count();
        $totalMasterKeamanan  = Keamanan::count();
        $totalMasterKebersihan = Kebersihan::count();

        // jika tidak ada data kost/kriteria
        if ($kosts->isEmpty() || $criterias->isEmpty()) {
            return view('admin.pages.topsis.perhitungan', [
                'hasilAkhir' => [],
                'kosts' => [],
                'criterias' => [],
                'matriksX' => []
            ]);
        }

        // membentuk matriks keputusan awal
        $matriksX = [];

        foreach ($kosts as $kost) {
            foreach ($criterias as $criteria) {
                $namaKriteriaClean = strtolower(trim($criteria->nama_kriteria));
                $nilaiRiil = 0;

                // logika persentasi relasi
                if (in_array($namaKriteriaClean, ['fasilitas', 'keamanan', 'kebersihan'])) {
                    $jumlahDicentang = $kost->$namaKriteriaClean ? $kost->$namaKriteriaClean->count() : 0;

                    if ($namaKriteriaClean === 'fasilitas') {
                        $nilaiRiil = $totalMasterFasilitas > 0 ? ($jumlahDicentang / $totalMasterFasilitas) * 100 : 0;
                    } elseif ($namaKriteriaClean === 'keamanan') {
                        $nilaiRiil = $totalMasterKeamanan > 0 ? ($jumlahDicentang / $totalMasterKeamanan) * 100 : 0;
                    } else {
                        $nilaiRiil = $totalMasterKebersihan > 0 ? ($jumlahDicentang / $totalMasterKebersihan) * 100 : 0;
                    }
                } else {
                    // logika angka murni
                    $nilaiRiil = $kost->$namaKriteriaClean ?? 0;
                }

                // cari kecocokan bobot
                $sub = SubCriteria::where('criteria_id', $criteria->id)
                    ->where('nilai_minimum', '<=', $nilaiRiil)
                    ->where('nilai_maksimum', '>=', $nilaiRiil)
                    ->first();

                $matriksX[$kost->id][$criteria->id] = $sub ? $sub->nilai : 1;
            }
        }

        // menghitung nilai pembagi
        $pembagi = [];
        foreach ($criterias as $criteria) {
            $totalKuadrat = 0;
            foreach ($kosts as $kost) {
                $totalKuadrat += pow($matriksX[$kost->id][$criteria->id], 2);
            }
            $pembagi[$criteria->id] = sqrt($totalKuadrat);
        }

        // normalisasi terbobot
        $matriksY = [];
        foreach ($kosts as $kost) {
            foreach ($criterias as $criteria) {
                // mengambil nilai bobot utama
                $bobotKriteriaUtama = $criteria->bobot ?? 1;

                $nilaiNormalisasi = $pembagi[$criteria->id] > 0 ? ($matriksX[$kost->id][$criteria->id] / $pembagi[$criteria->id]) : 0;
                $matriksY[$kost->id][$criteria->id] = $nilaiNormalisasi * $bobotKriteriaUtama;
            }
        }

        $solusiPositif = [];
        $solusiNegatif = [];

        foreach ($criterias as $criteria) {
            $nilaiKolomY = [];
            foreach ($kosts as $kost) {
                $nilaiKolomY[] = $matriksY[$kost->id][$criteria->id];
            }

            // Ideal Positif (A+) selalu nilai MAKSIMUM
            // Ideal Negatif (A-) selalu nilai MINIMUM
            $solusiPositif[$criteria->id] = max($nilaiKolomY);
            $solusiNegatif[$criteria->id] = min($nilaiKolomY);
        }

        // menghitung jarak solusi ideal
        $hasilAkhir = [];

        foreach ($kosts as $kost) {
            $jumlahDPositif = 0;
            $jumlahDNegatif = 0;

            foreach ($criterias as $criteria) {
                $jumlahDPositif += pow($matriksY[$kost->id][$criteria->id] - $solusiPositif[$criteria->id], 2);
                $jumlahDNegatif += pow($matriksY[$kost->id][$criteria->id] - $solusiNegatif[$criteria->id], 2);
            }

            $dPositif = sqrt($jumlahDPositif);
            $dNegatif = sqrt($jumlahDNegatif);

            // rumus skor preferensi
            $skorV = ($dPositif + $dNegatif) > 0 ? ($dNegatif / ($dPositif + $dNegatif)) : 0;

            $hasilAkhir[] = [
                'kost_id'   => $kost->id,
                'nama_kost' => $kost->nama_kost,
                'harga'     => $kost->harga,
                'd_positif' => $dPositif,
                'd_negatif' => $dNegatif,
                'skor_v'    => $skorV
            ];
        }

        // ---------------------------------------------------------
        // PERBAIKAN: Perangkingan dengan Tie-Breaker
        // ---------------------------------------------------------
        usort($hasilAkhir, function ($a, $b) {
            // 1. Urutkan berdasarkan skor V dari yang terbesar (Descending)
            if ($b['skor_v'] != $a['skor_v']) {
                return $b['skor_v'] <=> $a['skor_v'];
            }

            // 2. Jika skor V SAMA persis, urutkan berdasarkan harga sewa termurah (Ascending)
            return $a['harga'] <=> $b['harga'];
        });

        $hasilAkhir = array_slice($hasilAkhir, 0, 10);

        // kirim ke view
        return view('admin.pages.topsis.perhitungan', compact('hasilAkhir', 'kosts', 'criterias', 'matriksX'));
    }
}
