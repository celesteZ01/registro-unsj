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
        $animals= [
            ['name' => 'Leo', 'species' => 'Tigre', 'age' => 5],
            ['name' => 'Milo', 'species' => 'Gato', 'age' => 2],
            ['name' => 'Max', 'species' => 'Perro', 'age' => 3],
            ['name' => 'Charlie', 'species' => 'Loro', 'age' => 4],
        ];

        // $this->animalService->reset();
        // foreach($animals as $a){
        //     $this->animalService->create($a);
        // }

        foreach ($animals as $a) {
            DB::insert(
                'INSERT INTO animals (name, species, age) VALUES (?, ?, ?)',
                [
                    $a['name'],
                    $a['species'], 
                    $a['age']
                 ]
            );
        }

        DB::insert(
            'INSERT INTO animals (name, species, age) VALUES ("Roco", "Tigre", 1)',
        );

        #otra forma de cargar datos especificando el nombre del campo
        // DB::table('animals')->insert([
        //     ['name' => 'Luna', 'species' => 'Gato', 'age' => 2],
        //     ['name' => 'Simba', 'species' => 'Perro', 'age' => 4],
        //     ['name' => 'Coco', 'species' => 'Loro', 'age' => 3],
        // ]);
    }
}
