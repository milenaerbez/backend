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
        Schema::create('adresa', function (Blueprint $table) {
            //$table->id();
            $table->unsignedInteger('id');
            $table->unsignedInteger('grad_id');
            $table->unsignedBigInteger('drzava_id'); // Add the drzava_id column.
            $table->string('ulica');

            // Define a foreign key constraint on 'grad_id' referencing 'id' and 'drzava_id' columns in 'grad' table.
            $table->foreign('grad_id')
                ->references('id')
                ->on('grad')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            // Define a foreign key constraint on 'drzava_id' referencing 'id' column in 'drzava' table.
            $table->foreign('drzava_id')
                ->references('id')
                ->on('drzava')
                ->onUpdate('cascade')
                ->onDelete('cascade');


            // Define a composite primary key on 'id', 'grad_id', and 'drzava_id'.
            $table->primary(['id', 'grad_id', 'drzava_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adresa');
    }
};