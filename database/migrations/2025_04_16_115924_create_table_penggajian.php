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
        Schema::create('penggajian', function (Blueprint $table) {
            $table->foreignId('id_jobdesk')->constrained('job_desks', 'id_jobdesk');
            $table->foreignId('id_crew')->constrained('crew', 'id_crew');
            $table->integer('nominal');
            $table->string('bukti_transfer')->nullable();
            $table->string('status');
            $table->string('periode_penggajian');
            $table->timestamps();
        
            $table->primary(['id_jobdesk', 'id_crew']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penggajian');
    }
};
