<?php

namespace App\Models;

use App\Models\Kost;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisKost extends Model
{
    use HasFactory;

    protected $fillable = [
        'jenis_kost'
    ];

    // relasi ke kost
    public function kost()
    {
        return $this->hasMany(Kost::class);
    }
}
