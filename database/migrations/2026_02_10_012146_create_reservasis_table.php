<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('reservasis', function (Blueprint $table) {
            $table->id('id_reservasi');
            $table->string('id_kamar');
            $table->string('nama_tamu');
            $table->string('no_hp');
            $table->date('check_in');
            $table->date('check_out');
            $table->integer('jumlah_tamu');
            $table->integer('total_bayar');
            $table->enum('status_reservasi', [
                'Booking',
                'Check-in',
                'Selesai',
                'Batal'
            ]);
            $table->timestamps();

            // RELASI
            $table->foreign('id_kamar')
                  ->references('id_kamar')
                  ->on('kamars')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservasis');
    }
};
