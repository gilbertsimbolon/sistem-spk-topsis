<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Fasilitas;
use App\Models\Kost;
use App\Models\PenilaianAlternatif;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'fakultas', 'password', 'role'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // relasi user ke owner_id
    public function kost()
    {
        return $this->hasMany(Kost::class, 'owner_id');
    }

    // relasi ke penilaian alternatif
    public function penilaianAlternatif()
    {
        return $this->hasMany(PenilaianAlternatif::class);
    }

    // relasi ke fasilitas
    public function fasilitas()
    {
        return $this->belongsToMany(Fasilitas::class, 'kost_fasilitas');
    }
}
