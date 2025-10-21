<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('jadwals', function (Blueprint $table) {
            $table->id();
            $table->enum('hari', ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu']); // Tambahkan Sabtu jika perlu
            $table->string('jam_ke');
            $table->time('waktu_mulai');
            $table->time('waktu_selesai');
            $table->foreignId('guru_id')->nullable()->constrained('gurus')->onDelete('set null'); // Guru yang mengajar di jadwal ini
            $table->foreignId('mapel_id')->nullable()->constrained('mapels')->onDelete('set null'); // Mapel yang diajarkan
            $table->foreignId('ruangan_id')->constrained('ruangans')->onDelete('cascade'); // Ruangan tempat
            $table->enum('status', ['Aktif', 'Istirahat'])->default('Aktif');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('jadwals');
    }
};