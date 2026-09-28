<?php

namespace App\Services;

use App\Contracts\AnimalServiceInterface;
use Illuminate\Support\Facades\Storage;
use Exception;

class FileAnimalService implements AnimalServiceInterface
{
    # nombre del archivo que se guardará en storage/app/animals.json
    private string $filePath = 'animals.json';

        private function getAnimals(): array
    {
        if (!Storage::disk('local')->exists($this->filePath)) { #maneja arch dentro del servidor.. por defecto apunta ala carpeta storage
            return [];
        }

        $json = Storage::disk('local')->get($this->filePath);
        return json_decode($json, true) ?? []; # toma el texto plano q está guardado en el archivo .json y lo convierte en un arreglo php manipulablee
    }

    private function saveAnimals(array $animals): void
    {
        $jsonContent = json_encode(array_values($animals), JSON_PRETTY_PRINT); # convierte el arreglo de php a formato texto json con salto de linea y todo eso 
        Storage::disk('local')->put($this->filePath, $jsonContent); # y lo guarda en el disco
    }

    # retorna todos los animales almacenados
    public function all(): array
    {
        $animals = $this->getAnimals();

        return array_map(function ($animal) {
            return [
                'id' => $animal['id'],
                'nombre' => $animal['name'] ?? $animal['nombre'] ?? '',
                'name' => $animal['name'] ?? $animal['nombre'] ?? '',
                'especie' => $animal['species'] ?? $animal['especie'] ?? '',
                'species' => $animal['species'] ?? $animal['especie'] ?? '',
                'edad' => $animal['age'] ?? $animal['edad'] ?? 0,
                'age' => $animal['age'] ?? $animal['edad'] ?? 0,
            ];
        }, $animals);
    }

    # busca un animal por su ID... si no existe, lanza una excepciónn
    public function find(int|string $id): ?array
    {
        $animals = $this->all();

        foreach ($animals as $animal) {
            if ($animal['id'] == $id) {
                return $animal;
            }
        }

        throw new Exception("El animal con ID {$id} no fue encontrado.");
    }

    #calcula el próximo ID, agrega el animal y guarda en disco
    public function create(array $data): array
    {
        $animals = $this->getAnimals();

        # calcular ID autoincremental: si está vacío arranca en 1 mmm
        $newId = empty($animals) ? 1 : max(array_column($animals, 'id')) + 1;

        $newAnimal = [
            'id' => $newId,
            'name' => $data['nombre'] ?? $data['name'],
            'species' => $data['especie'] ?? $data['species'],
            'age' => (int)($data['edad'] ?? $data['age'])
        ];

        $animals[] = $newAnimal;
        $this->saveAnimals($animals);

        return $newAnimal;
    }

    # actualiza los datos de un animal existente
    public function update(int|string $id, array $data): bool
    {
        $animals = $this->getAnimals();
        $found = false;

        foreach ($animals as &$animal) {
            if ($animal['id'] == $id) {
                $animal['name'] = $data['nombre'] ?? $data['name'] ?? $animal['name'];
                $animal['species'] = $data['especie'] ?? $data['species'] ?? $animal['species'];
                $animal['age'] = isset($data['edad']) ? (int)$data['edad'] : (isset($data['age']) ? (int)$data['age'] : $animal['age']);
                $found = true;
                break;
            }
        }

        if (!$found) {
            throw new Exception("El animal con ID {$id} no fue encontrado.");
        }

        $this->saveAnimals($animals);
        return true;
    }

    # elimina el animal con ese ID del listado y guarda en disco
    public function delete(int|string $id): bool
    {
        $animals = $this->getAnimals();
        $initialCount = count($animals);

        $animals = array_filter($animals, function ($animal) use ($id) {
            return $animal['id'] != $id;
        });

        # si la cantidad no cambió, significa que el ID no existía
        if (count($animals) === $initialCount) {
            throw new Exception("El animal con ID {$id} no fue encontrado.");
        }

        $this->saveAnimals($animals);
        return true;
    }

    # limpia el archivo o lo inicializa con los datos semilla
    public function reset(): void
    {
        $seedData = [
            [
                'id' => 1,
                'name' => 'Milo',
                'species' => 'Perro',
                'age' => 4
            ],
            [
                'id' => 2,
                'name' => 'Luna',
                'species' => 'Gato',
                'age' => 2
            ]
        ];

        $this->saveAnimals($seedData);
    }
}