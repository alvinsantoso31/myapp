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
        Schema::create('rule_penggajian', function (Blueprint $table) {
            $table->id('id_rule_penggajian');
            $table->string('nama_rule');
            $table->string('level');
            $table->foreignId('id_jobdesk')->constrained('job_desks', 'id_jobdesk');
            $table->string('lokasi');
            $table->string('tipe_event');
            $table->boolean('isAddons')->default(false);
            $table->integer('gaji_minimal');
            $table->integer('gaji_perjam');
            $table->timestamp('timestamp');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rule_penggajian');
    }
};
