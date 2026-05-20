<?php

namespace App\Models;

use App\Models\Kost;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FotoKost extends Model
{
    use HasFactory;

    protected $fillable = [
        'kost_id',
        'foto',
    ];

    // relasi ke model kost
    public function kost()
    {
        return $this->belongsTo(Kost::class);
    }
}
