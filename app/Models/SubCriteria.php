<?php

namespace App\Models;

use App\Models\Criteria;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCriteria extends Model
{
    use HasFactory;

    protected $fillable = [
        'criteria_id',
        'nama_sub_kriteria',
        'nilai',
    ];

    // relasi ke criteria
    public function criteria()
    {
        return $this->belongsTo(Criteria::class);
    }
}
