<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'kode', 'guru_pengajar_id']; // Tambahkan 'guru_pengajar_id'

    public function jadwals()
    {
        return $this->hasMany(Jadwal::class, 'mapel_id');
    }

    public function guruPengajar()
    {
        return $this->belongsTo(Guru::class, 'guru_pengajar_id'); // Relasi ke guru pengajar
    }
}