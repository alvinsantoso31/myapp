<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id('id_event');
            $table->string('nama_event');
            $table->text('deskripsi_event');
            $table->date('tanggal_event');
            $table->date('tanggal_closing');
            $table->string('lokasi_event');
            $table->timestamp('jadwal_briefing');
            $table->string('tipe_event');
            $table->string('status')->default('pre-event');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
