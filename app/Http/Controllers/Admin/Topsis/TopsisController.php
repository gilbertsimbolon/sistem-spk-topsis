<?php

namespace App\Http\Controllers\Admin\Topsis;

use App\Http\Controllers\Controller;
use App\Models\Criteria;
use App\Models\Kost;
use Illuminate\Http\Request;

class TopsisController extends Controller
{
    public function hitung()
    {
        // 1. Ambil semua data master
        $kosts = Kost::with('penilaianAlternatif')->get();
        $criterias = Criteria::all();

        if ($kosts->isEmpty() || $criterias->isEmpty()) {
            return redirect()->back()->with('error', 'Data Kost atau Kriteria masih kosong!');
        }

        // ==========================================
        // TAHAP A: MEMBENTUK MATRIKS KEPUTUSAN (X)
        // ==========================================
        $matriksX = [];
        foreach ($kosts as $kost) {
            foreach ($criterias as $criteria) {
                $namaKriteria = strtolower($criteria->nama_kriteria);

                // Logika Otomatis untuk Kriteria Harga
                if ($namaKriteria == 'harga') {
                    $matriksX[$kost->id][$criteria->id] = $kost->harga;
                } 
                // Logika Otomatis untuk Kriteria Fasilitas (Menghitung jumlah relasi fasilitas)
                elseif ($namaKriteria == 'fasilitas') {
                    // Asumsi model Kost memiliki relasi 'fasilitas' (Many to Many / Has Many)
                    $matriksX[$kost->id][$criteria->id] = $kost->fasilitas ? count(explode(',', $kost->fasilitas)) : 0;
                } 
                // Kriteria Manual yang diambil dari tabel penilaian_alternatifs
                else {
                    $penilaian = $kost->penilaianAlternatif->where('criteria_id', $criteria->id)->first();
                    $matriksX[$kost->id][$criteria->id] = $penilaian ? $penilaian->nilai : 0;
                }
            }
        }

        // ==========================================
        // TAHAP B: MENGHITUNG PEMBAGI & NORMALISASI MATRIKS (R)
        // ==========================================
        $pembantiKuadrat = [];
        foreach ($criterias as $criteria) {
            $sum = 0;
            foreach ($kosts as $kost) {
                $sum += pow($matriksX[$kost->id][$criteria->id], 2);
            }
            $pembantiKuadrat[$criteria->id] = sqrt($sum);
        }

        $matriksR = [];
        foreach ($kosts as $kost) {
            foreach ($criterias as $criteria) {
                $pembagi = $pembantiKuadrat[$criteria->id];
                $matriksR[$kost->id][$criteria->id] = $pembagi > 0 ? $matriksX[$kost->id][$criteria->id] / $pembagi : 0;
            }
        }

        // ==========================================
        // TAHAP C: MATRIKS NORMALISASI TERBOBOT (Y)
        // ==========================================
        $matriksY = [];
        foreach ($kosts as $kost) {
            foreach ($criterias as $criteria) {
                $matriksY[$kost->id][$criteria->id] = $matriksR[$kost->id][$criteria->id] * $criteria->bobot;
            }
        }

        // ==========================================
        // TAHAP D: SOLUSI IDEAL POSITIF (A+) & NEGATIF (A-)
        // ==========================================
        $solusiPositif = [];
        $solusiNegatif = [];
        foreach ($criterias as $criteria) {
            $kolomY = [];
            foreach ($kosts as $kost) {
                $kolomY[] = $matriksY[$kost->id][$criteria->id];
            }

            if (strtolower($criteria->tipe) == 'benefit') {
                $solusiPositif[$criteria->id] = max($kolomY);
                $solusiNegatif[$criteria->id] = min($kolomY);
            } else { // Jika Tipe Cost (Harga & Jarak)
                $solusiPositif[$criteria->id] = min($kolomY); // Cost: makin kecil makin positif
                $solusiNegatif[$criteria->id] = max($kolomY);
            }
        }

        // ==========================================
        // TAHAP E & F: JARAK SOLUSI (D+, D-) & NILAI PREFERENSI (V)
        // ==========================================
        $hasilAkhir = [];
        foreach ($kosts as $kost) {
            $sumDPositif = 0;
            $sumDNegatif = 0;

            foreach ($criterias as $criteria) {
                $sumDPositif += pow($matriksY[$kost->id][$criteria->id] - $solusiPositif[$criteria->id], 2);
                $sumDNegatif += pow($matriksY[$kost->id][$criteria->id] - $solusiNegatif[$criteria->id], 2);
            }

            $dPositif = sqrt($sumDPositif);
            $dNegatif = sqrt($sumDNegatif);

            // Rumus Nilai Preferensi V
            $v = ($dPositif + $dNegatif) > 0 ? $dNegatif / ($dPositif + $dNegatif) : 0;

            $hasilAkhir[] = [
                'kost_id'   => $kost->id,
                'nama_kost' => $kost->nama_kost,
                'harga'     => $kost->harga,
                'd_positif' => $dPositif,
                'd_negatif' => $dNegatif,
                'skor_v'    => $v
            ];
        }

        // Urutkan hasil dari skor_v tertinggi ke terendah (Perangkingan)
        usort($hasilAkhir, function ($a, $b) {
            return $b['skor_v'] <=> $a['skor_v'];
        });

        return view('admin.pages.topsis.perhitungan', compact('criterias', 'kosts', 'matriksX', 'hasilAkhir'));
    }
}
