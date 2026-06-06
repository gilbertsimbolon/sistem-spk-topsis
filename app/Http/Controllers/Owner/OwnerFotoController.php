<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\FotoKost;
use App\Models\Kost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OwnerFotoController extends Controller
{
    public function store(Request $request, $kost)
    {
        $request->validate([
            'foto.*' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $kost = Kost::findOrFail($kost);

        if ($request->hasFile('foto')) {

            foreach ($request->file('foto') as $file) {

                $path = $file->store('kost_foto', 'public');

                $kost->foto()->create([
                    'foto' => $path,
                ]);
            }
        }

        return back()->with('success', 'Foto berhasil ditambahkan');
    }

    public function destroy(string $id)
    {
        $foto = FotoKost::findOrFail($id);

        // hapus file
        if (Storage::disk('public')->exists($foto->foto)) {
            Storage::disk('public')->delete($foto->foto);
        }

        // hapus record dataase
        $foto->delete();

        return back()->with('success', 'Foto erhasil dihapus');
    }
}
