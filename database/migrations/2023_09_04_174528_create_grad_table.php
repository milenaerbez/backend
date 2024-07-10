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
        Schema::create('grad', function (Blueprint $table) {
            //$table->id();
            $table->unsignedInteger('id');
            $table->foreignId('drzava_id')->constrained('drzava');
            $table->string('naziv');
            $table->timestamps();
            $table->primary(['id', 'drzava_id']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grad');
    }
};