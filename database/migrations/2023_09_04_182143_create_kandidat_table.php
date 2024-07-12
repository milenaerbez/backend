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
        Schema::create('kandidat', function (Blueprint $table) {
            $table->id();
            $table->string('Ime');
            $table->string('Prezime');
            $table->string('JMBG');
            $table->string('Zvanje');
            $table->unsignedInteger('adresa_id');
            $table->unsignedInteger('grad_id');
            $table->unsignedBigInteger('drzava_id');
            $table->string('kucniBroj');




            $table->foreign('grad_id')
                ->references('id')
                ->on('grad')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('drzava_id')
                ->references('drzava_id') 
                ->on('adresa')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('adresa_id')
                ->references('id') 
                ->on('adresa')
                ->onUpdate('cascade')
                ->onDelete('cascade');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kandidat');
    }
};