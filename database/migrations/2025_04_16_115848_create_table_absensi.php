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
        Schema::create('absensi', function (Blueprint $table) {
            $table->id('id_absen');
            $table->foreignId('id_detail_event')->constrained('detail_events', 'id_detail_event');
            $table->boolean('isAbsen')->default(false);
            $table->string('tipe_absen');
            $table->timestamp('timestamp')->nullable();
            $table->integer('denda')->default(0);
            $table->string('bukti_denda')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_absensi');
    }
};
