<?php

namespace App\Services;

use App\Contracts\AnimalServiceInterface;
use App\Exceptions\AnimalNotFoundException;
use Illuminate\Support\Facades\DB;
class SQLAnimalService implements AnimalServiceInterface
{
    public function all(): array {
        $rows= DB::select('SELECT id, name, species, age FROM animals');
        $result= array_map(function ($row) { #para cada uno de los elementos del arreglo retornado va convirtiendo cada una de las filas en un array asociativo
            return (array) $row;
        }, $rows);
        return $result;
    }

    public function find(int|string $id): array {
        $row= DB::selectOne('SELECT id, name, species, age FROM animals WHERE id = ?', [$id]);

        if (!$row) { #si no lo encuentra
            throw AnimalNotFoundException::forId(($id));
        }
        return (array) $row;
    }

    public function create(array $data): array {
        
        DB::insert('INSERT INTO animals (name, species, age) VALUES (?, ?, ?)', 
        [
            $data['name'], 
            $data['species'], 
            $data['age']
        ]);

        $id= DB::getPdo()->lastInsertId(); #obtengo el id del ultimo insert
        return $this->find($id);

    }

    public function update(string|int $id, array $data): bool {
        #verificación previa (falla rápida con 404 si no existe)
        $this->find($id);

        #sentencia SQL con los nuevos datos 
        DB::update('UPDATE animals SET name = ?, species = ?, age = ? WHERE id = ?', 
        [
            $data['name'], 
            $data['species'], 
            $data['age'], 
            $id
        ]);
        // return $this->find($id);
        return true;
    }

    public function delete(int|string $id): bool {
        #asegura existencia o lanza excepción
        $this->find($id);

        $affected= DB::delete('DELETE FROM animals WHERE id = ?', [$id]);
        return $affected > 0;
    }

    public function reset(): void {
        DB::statement('DELETE FROM animals');
        #reinicar el puntero aotoincremental de SQLite
        DB::statement('DELETE FROM sqlite_sequence WHERE name = "animals"');
    }

}