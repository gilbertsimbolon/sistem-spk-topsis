<?php

namespace App\Models;

use App\Models\PenilaianAlternatif;
use App\Models\SubCriteria;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_kriteria',
        'nama_kriteria',
        'tipe',
        'bobot',
    ];

    // relasi ke subCriteria
    public function subCriteria()
    {
        return $this->hasMany(SubCriteria::class);
    }

    // relasi ke penilaian alternatif
    public function penilaianAlternatif()
    {
        return $this->hasMany(PenilaianAlternatif::class);
    }
}
