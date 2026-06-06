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

class OwnerKostController extends Controller
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
        // PERBAIKAN VALIDASI: Menjamin sistem menerima segala jenis aspek rasio foto layout apa saja
        // Batasan ukuran dinaikkan menjadi max 5MB (5120 KB) karena kamera portrait HP resolusinya besar
        $request->validate([
            'nama_kost' => 'required|string|max:255',
            'alamat' => 'required|string',
            'harga' => 'required|numeric',
            'jenis_kost_id' => 'required',
            'daerah_kost_id' => 'required',
            'foto' => 'nullable|array',
            'foto.*' => 'image|mimes:jpeg,png,jpg,webp|max:5120',
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

            // 2. ATTACH RELASI
            $kost->fasilitas()->attach($request->fasilitas ?? []);
            $kost->keamanan()->attach($request->keamanan ?? []);
            $kost->kebersihan()->attach($request->kebersihan ?? []);

            // 3. UPLOAD FOTO (Mendukung Multi-Layout Portrait/Landscape)
            if ($request->hasFile('foto')) {
                foreach ($request->file('foto') as $file) {
                    $path = $file->store('kost', 'public');
                    FotoKost::create([
                        'kost_id' => $kost->id,
                        'foto' => $path
                    ]);
                }
            }

            DB::commit(); // Simpan semua perubahan
            
            // PERBAIKAN ROUTE: Menyesuaikan ke rute alias group owner yang sah
            return redirect()->route('owner.kost.index')->with('success', 'Data kost berhasil ditambahkan!');
            
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
        // PERBAIKAN VALIDASI UPDATE: Mengizinkan semua ekstensi gambar modern dengan kapasitas ukuran besar
        $request->validate([
            'nama_kost' => 'required|string|max:255',
            'alamat' => 'required|string',
            'harga' => 'required|numeric',
            'jenis_kost_id' => 'required',
            'daerah_kost_id' => 'required',
            'foto' => 'nullable|array',
            'foto.*' => 'image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        // Pastikan hanya bisa update kost miliknya sendiri
        $kost = Kost::where('id', $id)->where('owner_id', Auth::id())->firstOrFail();

        DB::beginTransaction();

        try {
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

            DB::commit();
            
            // PERBAIKAN ROUTE: Diarahkan kembali ke indeks owner yang benar
            return redirect()->route('owner.kost.index')->with('success', 'Data kost berhasil diperbarui!');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kost = Kost::where('id', $id)->where('owner_id', Auth::id())->firstOrFail();
        $kost->delete();

        // PERBAIKAN ROUTE: Menyesuaikan rute sukses hapus data owner
        return redirect()->route('owner.kost.index')->with('success', 'Data kost berhasil dihapus!');
    }
}