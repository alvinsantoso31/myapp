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
        Schema::create('detail_events', function (Blueprint $table) {
            $table->id('id_detail_event');
            $table->foreignId('id_crew')->constrained('crew', 'id_crew');
            $table->foreignId('id_event')->constrained('events', 'id_event');
            $table->foreignId('id_jobdesk')->constrained('job_desks', 'id_jobdesk');
            $table->integer('performa')->nullable();
            $table->text('notes_performa')->nullable();
            $table->text('notes')->nullable();
            $table->boolean('isAddons')->default(false);
            $table->integer('durasiAddons')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_events');
    }
};
