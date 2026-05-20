<?php

namespace App\Http\Controllers\Admin\ManajemenKost;

use App\Http\Controllers\Controller;
use App\Models\Fasilitas;
use App\Models\FotoKost;
use App\Models\JenisKost;
use App\Models\Kost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class KostController extends Controller
{
    /**
     * Fungsi Untuk Mengambil Data.
     */
    public function index()
    {
        $kost = Kost::with('jenis', 'fasilitas', 'foto')->get();
        // dd($kost);
        $jenis = JenisKost::all();
        $fasilitas = Fasilitas::all();

        return view('admin.pages.manajemenkost.data-kost', compact('kost', 'jenis', 'fasilitas'));
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
        ]);

        DB::beginTransaction();

        try {
            // simpan kost
            $kost = Kost::create([
                'nama_kost' => $request->nama_kost,
                'alamat' => $request->alamat,
                'harga' => $request->harga,
                'jenis_kost_id' => $request->jenis_kost_id,
            ]);

            // fasilitas kost relasi many to many
            if ($request->fasilitas) {
                $kost->fasilitas()->attach($request->fasilitas);
            }

            // foto (untuk multiple upload)
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
        $kost = Kost::findOrFail($id);

        DB::beginTransaction();

        try{
            // update data kost
            $kost->update([
                'nama_kost' => $request->nama_kost,
                'alamat' => $request->alamat,
                'harga' => $request->harga,
                'jenis_kost_id' => $request->jenis_kost_id,
            ]);

            // sinkronisasi fasilitas
            $kost->fasilitas()->sync($request->fasilitas ?? []);

            // foto baru (optional)
             if ($request->hasFile('foto')) {
                foreach ($request->file('foto') as $file) {

                    $path = $file->store('kost', 'public');

                    $kost->foto()->create([
                        'foto' => $path
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('data-kost.index')->with('success', 'Data berhasil diperbarui');
        }catch (\Exception $e) {
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

        // hapus foto dari path
        foreach ($kost->foto as $foto) {
            Storage::disk('public')->delete($foto->foto);
        }

        $kost->delete();

        return redirect()->route('data-kost.index')->with('success', 'Data berhasil dihapus');
    }
}
