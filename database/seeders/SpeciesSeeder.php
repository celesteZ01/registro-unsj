<?php

namespace Database\Seeders;

use App\Contracts\SpeciesServiceInterface;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder; 
use Illuminate\Support\Facades\DB; #permite usar el facade DB para hacer inserts en la tabla species

class SpeciesSeeder extends Seeder
{

    public function __construct(
        protected SpeciesServiceInterface $speciesService
    ){}
    public function run(): void
    {
        DB::table('species')->insert([ #array con 10 especies
            ['name' => 'Perro'],
            ['name' => 'Gato'],
            ['name' => 'Loro'],
        //     ['name' => 'Caballo'],
        //     ['name' => 'Pez'],
        //     ['name' => 'Elefante'],
        //     ['name' => 'Tigre'],
        //     ['name' => 'Oso'],
        //     ['name' => 'Tortuga'],
        //     ['name' => 'Jirafa'],
        //     ['name' => 'Serpiente']
        ]);
        // foreach ($species as $esp) {
        //     DB:: insert ('INSERT INTO species (name) VALUES  (?)', #plantilla sql
        //     [$esp['name']] #valores reales
        //     );
        // }
    }
}
