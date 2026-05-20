<?php

namespace App\Models;

use App\Models\Fasilitas;
use App\Models\FotoKost;
use App\Models\JenisKost;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kost extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_kost',
        'alamat',
        'harga',
        'deskripsi',
        'jenis_kost_id',
        'owner_id',
    ];

    // Relasi untuk mengambil jenis kost
    public function jenis()
    {
        return $this->belongsTo(JenisKost::class, 'jenis_kost_id', 'id');
    }

    // Relasi untuk mengambil fasilitas kost
    public function fasilitas()
    {
        return $this->belongsToMany(Fasilitas::class, 'kost_fasilitas');
    }

    // Relasi untuk mengambil foto kost
    public function foto()
    {
        return $this->hasMany(FotoKost::class);
    }

    // relasi untuk pemilik kost
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
}
