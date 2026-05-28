<?php

namespace App\Models;

use App\Models\Criteria;
use App\Models\Kost;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianAlternatif extends Model
{
    use HasFactory;

    protected $table = 'penilaian_alternatifs';
    protected $fillable = [
        'kost_id',
        'criteria_id',
        'nilai',
    ];

    // relasi ke kost
    public function kost()
    {
        return $this->belongsTo(Kost::class);
    }

    // relasi ke criteria
    public function criteria()
    {
        return $this->belongsTo(Criteria::class);
    }
}
