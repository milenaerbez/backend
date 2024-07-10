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
        Schema::create('stavka_ugovora', function (Blueprint $table) {
            //$table->id();
            $table->unsignedInteger('id');
            $table->foreignId('ugovor_id')->constrained('ugovor');
            $table->string('sadrzaj');
            $table->unsignedInteger('clan_id');
            $table->unsignedBigInteger('zakonik_id');
            $table->timestamps();


            $table->primary(['id', 'ugovor_id']);

            $table->foreign('clan_id')
                ->references('id')
                ->on('clan_zakonika')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('zakonik_id')
                ->references('id')
                ->on('zakonik')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stavka_ugovora');
    }
};