<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'kode', 'kapasitas', 'penanggung_jawab_id']; // Tambahkan 'penanggung_jawab_id'

    public function jadwals()
    {
        return $this->hasMany(Jadwal::class, 'ruangan_id');
    }

    public function penanggungJawab()
    {
        return $this->belongsTo(Guru::class, 'penanggung_jawab_id'); // Relasi ke penanggung jawab
    }
}