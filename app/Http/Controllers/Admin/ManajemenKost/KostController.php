<?php

namespace App\Http\Controllers\Admin\ManajemenKost;

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
use Illuminate\Support\Facades\Storage;

class KostController extends Controller
{
    /**
     * Fungsi Untuk Mengambil Data.
     */
    public function index()
    {
        $kost = Kost::with(['jenis', 'fasilitas', 'keamanan', 'kebersihan', 'foto', 'daerah'])->get();
        $jenis = JenisKost::all();
        $daerah = DaerahKost::all();
        $fasilitas = Fasilitas::all();
        $keamanan = Keamanan::all();
        $kebersihan = Kebersihan::all();
        $foto = FotoKost::all();

        return view('admin.pages.manajemenkost.data-kost', compact('kost', 'jenis', 'fasilitas', 'keamanan', 'kebersihan', 'daerah', 'foto'));
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
            'nama_kost' => 'required',
            'alamat' => 'required',
            'harga' => 'required|numeric',
            'jenis_kost_id' => 'required',
            'daerah_kost_id' => 'required',
        ]);

        DB::beginTransaction();

        try {
            // 1. Simpan data utama Kost
            $kost = Kost::create([
                'nama_kost' => $request->nama_kost,
                'alamat' => $request->alamat,
                'harga' => $request->harga,
                'jenis_kost_id' => $request->jenis_kost_id,
                'daerah_kost_id' => $request->daerah_kost_id,
                'owner_id' => Auth::id(),
            ]);

            // 2. Simpan Relasi Many-to-Many menggunakan attach() bawaan Eloquent Laravel
            // Jika checkbox tidak dicentang, fallback ke array kosong []
            $kost->fasilitas()->attach($request->fasilitas ?? []);
            $kost->keamanan()->attach($request->keamanan ?? []);
            $kost->kebersihan()->attach($request->kebersihan ?? []);

            // 3. Upload Multi-Foto
            if ($request->hasFile('foto')) {
                foreach ($request->file('foto') as $file) {
                    $path = $file->store('kost', 'public');

                    FotoKost::create([
                        'kost_id' => $kost->id,
                        'foto' => $path
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('data-kost.index')->with('success', 'Data kost berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // 1. Ambil data kost detail berdasarkan ID beserta relasinya
        $kost = Kost::with(['foto', 'jenis', 'daerah', 'fasilitas', 'keamanan', 'kebersihan'])->findOrFail($id);

        // 2. Ambil semua data master untuk keperluan Modal Edit di halaman detail
        $jenis = JenisKost::all(); // Sesuaikan nama model Jenis Kost Anda
        $daerah = DaerahKost::all();   // Sesuaikan nama model Daerah Anda
        $fasilitas = Fasilitas::all();
        $keamanan = Keamanan::all();
        $kebersihan = Kebersihan::all();

        // 3. Kirim SEMUA variabel ke view detail
        return view('admin.pages.manajemenkost.detail-kost', compact(
            'kost', 
            'jenis', 
            'daerah', 
            'fasilitas', 
            'keamanan', 
            'kebersihan'
        ));
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
        $kost = Kost::findOrFail($id);

        $request->validate([
            'nama_kost' => 'required',
            'alamat' => 'required',
            'harga' => 'required|numeric',
            'jenis_kost_id' => 'required',
            'daerah_kost_id' => 'required',
        ]);

        DB::beginTransaction();

        try {
            // 1. Update data utama Kost
            $kost->update([
                'nama_kost' => $request->nama_kost,
                'alamat' => $request->alamat,
                'harga' => $request->harga,
                'jenis_kost_id' => $request->jenis_kost_id,
                'daerah_kost_id' => $request->daerah_kost_id,
            ]);

            // 2. Sinkronisasi Relasi menggunakan sync() bawaan Eloquent
            // Fungsi ini otomatis menghapus data lama di pivot dan mengganti dengan data baru dari request
            $kost->fasilitas()->sync($request->fasilitas ?? []);
            $kost->keamanan()->sync($request->keamanan ?? []);
            $kost->kebersihan()->sync($request->kebersihan ?? []);

            // 3. Upload Foto Baru (Jika ada file baru yang diunggah)
            if ($request->hasFile('foto')) {
                foreach ($request->file('foto') as $file) {
                    $path = $file->store('kost', 'public');

                    $kost->foto()->create([
                        'foto' => $path
                    ]);
                }
            }

            DB::commit();

            return redirect()->back()->with('success', 'Data berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kost = Kost::findOrFail($id);

        // Hapus file fisik foto dari storage public
        foreach ($kost->foto as $foto) {
            Storage::disk('public')->delete($foto->foto);
        }

        // Relasi pivot (kost_fasilitas, kost_keamanan, kost_kebersihan) otomatis terhapus 
        // karena Anda sudah menambahkan onDelete('cascade') di file migration.
        $kost->delete();

        return redirect()->route('data-kost.index')->with('success', 'Data berhasil dihapus');
    }
}