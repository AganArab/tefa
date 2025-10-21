<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'nip', 'foto']; // Tambahkan 'foto'

    public function jadwals()
    {
        return $this->hasMany(Jadwal::class, 'guru_id');
    }

    public function mapelGuruPengajar()
    {
        return $this->hasMany(Mapel::class, 'guru_pengajar_id');
    }

    public function ruanganPenanggungJawab()
    {
        return $this->hasMany(Ruangan::class, 'penanggung_jawab_id');
    }
}