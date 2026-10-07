<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder; 
use Illuminate\Support\Facades\DB; #permite usar el facade DB para hacer inserts en la tabla species

class SpeciesSeeder extends Seeder
{
    public function run(): void
    {
        $species= [ #array con 10 especies
            ['name' => 'Perro'],
            ['name' => 'Gato'],
            ['name' => 'Conejo'],
            ['name' => 'Caballo'],
            ['name' => 'Pez'],
            ['name' => 'Elefante'],
            ['name' => 'Tigre'],
            ['name' => 'Oso'],
            ['name' => 'Tortuga'],
            ['name' => 'Jirafa'],
            ['name' => 'Serpiente']
        ];
        foreach ($species as $esp) {
            DB:: insert ('INSERT INTO species (name) VALUES  (?)', #plantilla sql
            [$esp['name']] #valores reales
            );
        }
    }
}
