<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\DaerahKost;
use App\Models\Fasilitas;
use App\Models\FotoKost;
use App\Models\JenisKost;
use App\Models\Keamanan;
use App\Models\Kebersihan;
use App\Models\Kost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Tarik semua data kost HANYA milik owner yang sedang login
        $kosts = Kost::with(['fasilitas', 'keamanan', 'kebersihan', 'jenis', 'daerah'])
            ->where('owner_id', Auth::id())
            ->get();

        // Ambil master data untuk keperluan Dropdown & Checkbox di Modal
        $fasilitas = Fasilitas::all();
        $keamanan = Keamanan::all();
        $kebersihan = Kebersihan::all();
        $jenis = JenisKost::all();
        $daerah = DaerahKost::all();

        return view('owner.index', compact(
            'kosts',
            'fasilitas',
            'keamanan',
            'kebersihan',
            'jenis',
            'daerah'
        ));
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
            'nama_kost' => 'required|string|max:255',
            'alamat' => 'required|string',
            'harga' => 'required|numeric',
            'jenis_kost_id' => 'required',
            'daerah_kost_id' => 'required',
        ]);

        DB::beginTransaction(); // Memulai transaksi agar data tidak setengah tersimpan

        try {
            // 1. BUAT KOST DULU
            $kost = Kost::create([
                'owner_id' => Auth::id(),
                'nama_kost' => $request->nama_kost,
                'alamat' => $request->alamat,
                'harga' => $request->harga,
                'jenis_kost_id' => $request->jenis_kost_id,
                'daerah_kost_id' => $request->daerah_kost_id,
            ]);

            // 2. ATTACH RELASI (sudah aman karena $kost sudah punya ID)
            $kost->fasilitas()->attach($request->fasilitas ?? []);
            $kost->keamanan()->attach($request->keamanan ?? []);
            $kost->kebersihan()->attach($request->kebersihan ?? []);

            // 3. UPLOAD FOTO
            if ($request->hasFile('foto')) {
                foreach ($request->file('foto') as $file) {
                    $path = $file->store('kost', 'public');
                    FotoKost::create([
                        'kost_id' => $kost->id, // Sekarang $kost->id sudah ada
                        'foto' => $path
                    ]);
                }
            }

            DB::commit(); // Simpan semua perubahan
            return redirect()->route('kost.index')->with('success', 'Data kost berhasil ditambahkan!');
            
        } catch (\Exception $e) {
            DB::rollback(); // Jika error, batalkan semua proses
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $kost = Kost::with(['fasilitas', 'keamanan', 'kebersihan', 'foto', 'jenis', 'daerah'])
            ->where('id', $id)
            ->where('owner_id', Auth::id())
            ->firstOrFail();

        $fasilitas = Fasilitas::all();
        $keamanan = Keamanan::all();
        $kebersihan = Kebersihan::all();
        $jenis = JenisKost::all();
        $daerah = DaerahKost::all();

        return view('owner.show', compact('kost', 'fasilitas', 'keamanan', 'kebersihan', 'jenis', 'daerah'));
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
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kost' => 'required|string|max:255',
            'alamat' => 'required|string',
            'harga' => 'required|numeric',
            'jenis_kost_id' => 'required',
            'daerah_kost_id' => 'required',
        ]);

        // Pastikan hanya bisa update kost miliknya sendiri
        $kost = Kost::where('id', $id)->where('owner_id', Auth::id())->firstOrFail();

        if ($request->hasFile('foto')) {
                foreach ($request->file('foto') as $file) {
                    $path = $file->store('kost', 'public');

                    $kost->foto()->create([
                        'foto' => $path
                    ]);
                }
            }

        $kost->update([
            'nama_kost' => $request->nama_kost,
            'alamat' => $request->alamat,
            'harga' => $request->harga,
            'jenis_kost_id' => $request->jenis_kost_id,
            'daerah_kost_id' => $request->daerah_kost_id,
        ]);

        // Sync relasi (menghapus yang lama dan mengganti dengan yang baru dicentang)
        $kost->fasilitas()->sync($request->fasilitas ?? []);
        $kost->keamanan()->sync($request->keamanan ?? []);
        $kost->kebersihan()->sync($request->kebersihan ?? []);

        return redirect()->route('kost.index')->with('success', 'Data kost berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kost = Kost::where('id', $id)->where('owner_id', Auth::id())->firstOrFail();
        $kost->delete();

        return redirect()->route('kost.index')->with('success', 'Data kost berhasil dihapus!');
    }
}
