<?php

namespace Database\Seeders;

use App\Contracts\AnimalServiceInterface;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; #DB::insert()

class AnimalSeeder extends Seeder
{

    // public function __construct(
    //     protected AnimalServiceInterface $animalService #recibe la interfaz
    // )   {}
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $animals= [ #actualizado acá clave foránea
            ['name' => 'Leo', 'species_id' => 1, 'age' => 5],
            ['name' => 'Milo', 'species_id' => 2, 'age' => 2],
            ['name' => 'Max', 'species_id' => 3, 'age' => 3],
            ['name' => 'Charlie', 'species_id' => 4, 'age' => 4],
            ['name' => 'Mojito', 'species_id' => 5, 'age' => 6],
        ];

        // $this->animalService->reset();
        // foreach($animals as $a){
        //     $this->animalService->create($a);
        // }

        foreach ($animals as $a) {
            DB::insert(
                'INSERT INTO animals (name, species_id, age) VALUES (?, ?, ?)', #actualizado acá clave foránea
                [
                    $a['name'],
                    $a['species_id'], 
                    $a['age']
                 ]
            );
        }

        // DB::insert(
        //     'INSERT INTO animals (name, species_id, age) VALUES ("Roco", "Tigre", 1)', #actualizado acá clave foránea
        // );

        #otra forma de cargar datos especificando el nombre del campo
        // DB::table('animals')->insert([
        //     ['name' => 'Luna', 'species' => 'Gato', 'age' => 2],
        //     ['name' => 'Simba', 'species' => 'Perro', 'age' => 4],
        //     ['name' => 'Coco', 'species' => 'Loro', 'age' => 3],
        // ]);
    }
}
