<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ugovor', function (Blueprint $table) {
            $table->id();
            $table->date('datum');
            $table->string('sadrzaj');
            $table->unsignedBigInteger('kandidat_id');
            $table->timestamps();

            $table->foreign('kandidat_id')
                ->references('id')
                ->on('kandidat')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ugovor');
    }
};