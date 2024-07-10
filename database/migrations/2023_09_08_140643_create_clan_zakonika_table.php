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
        Schema::create('clan_zakonika', function (Blueprint $table) {
            //$table->id();
            $table->unsignedInteger('id');
            $table->foreignId('zakonik_id')->constrained('zakonik');
            $table->string('brojClana');
            $table->string('sadrzaj');

            $table->timestamps();

            $table->primary(['id', 'zakonik_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clan_zakonika');
    }
};