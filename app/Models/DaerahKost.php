<?php

namespace App\Models;

use App\Models\Kost;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaerahKost extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // relasi ke kost
    public function kost()
    {
        return $this->hasMany(Kost::class);
    }
    
}
