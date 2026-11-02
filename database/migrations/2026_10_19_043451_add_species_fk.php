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
        Schema::table('animals', function (Blueprint $table) {
            $table->dropColumn('species');
            $table->foreignId('species_id')->constrained('species')->onDelete('cascade');#cuando se borra la especie, se borra en cascada
            #$table->foreign('species_id')->references('id')->on('species');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('animales', function (Blueprint $table){
            $table->string('species');
            $table->dropForeign(['species_id']); #se borra indice
            $table->dropColumn('species_id'); #se borra columna
        });
    }
};
