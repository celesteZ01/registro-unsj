<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
   
    public function up(): void
    {
        Schema::create('animal_events', function (Blueprint $table) { #chequear con event sino
            $table->id();
            
            $table->foreignId('animal_id')
                ->constrained('animals');

            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users');

            $table->dateTime('event_date');

            $table->enum('event_type', [
                'consulta', 
                'vacunación', 
                'tratamiento',
                'cirugía',
                'laboratorio',
                'hospitalización',
                'venta',
                'otro',
            ]);

            $table->text('description')->nullable();

            $table->decimal('amount', 12, 2)
                ->nullable();

            $table->timestamps();

            // $table->index(
            //     ['animal_id', 'event_date'], #incide que unifica animal_id y event_date, para poder buscar eventos de un animal en un rango de fechas
            //     'animal_events_animal_date_index'
            // );

            // $table->index('event_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('animal_events');
    }
};