<?php

namespace App\Services;

use App\Contracts\SpeciesServiceInterface;
use App\Exceptions\SpeciesNotFoundException;
use Illuminate\Support\Facades\DB;

class SQLSpeciesService implements SpeciesServiceInterface
{
    # Query Builder de Laravel
    protected string $table = 'species';
    public function all(): array
    {
        return DB::table($this->table)      #SELECT * RFOM species
            ->orderBy('id', 'asc')          #ORDER BY id ASC
            ->get()                         #ejecutar la consulta y obtener los resultados.
            ->map(fn($item) => (array) $item)
            ->toArray();

        /** lo que hace ne pseudo
            * 1. cargar en $items  todo lo que devuelve SELECT * FROM species ORDER BY id ASC
            * 2. convertir cada elemento de $items a un array asociativo
            * 2.a for each $item in $items, convertir $item en un array asociativo
            * 3. devolver $items como un array de arrays asociativos
        */
    }

    public function find(string $id): ?array
    {
        $item = DB::table($this->table)
            ->where('id', $id)
            ->first();
        return $item ? (array) $item : null;
        /** 
            * lo que hace en pseudo
            * 1. cargar en $item lo que devuelve SELECT * FROM species WHERE id = $id
            * 2. si $item es null, devolver null
            * 3. si $item no es null, convertirlo a un array asociativo (return (array) $item)
            * 4. devolver $item como un array asociativo
        */
    }

    public function create(array $data): array
    {
        $id = DB::table($this->table)->insertGetId([
            'name' => $data['name'],
        ]);
        return $this->find((string) $id);

        /**  
            * INSERT INTO species (name) VALUES ($data['name'])
            * SELECT * FROM species WHERE id = $id
            * pseudo
            * 1. insertar en la tabla $this->table los datos de $data
            * 2. obtener el ID del registro insertado
            * 3. buscar y devolver el registro con ese ID
        */
    }

    public function update(string $id, array $data): ?array
    {
        DB::table($this->table)
            ->where('id', $id)
            ->update([
                'name' => $data['name'],
            ]);
        return $this->find($id);
    }
    public function delete(string $id): bool
    {
        $deleted = DB::table($this->table)
            ->where('id', $id)->delete();
        return $deleted > 0;
    }

    public function reset(): void
    {
        // 1. Vaciamos todos los registros:
        DB::table($this->table)->delete();
        // 2. Pro-Tip SQLite visto en clase pasada: Reiniciar el puntero autoincremental
        DB::statement("DELETE FROM sqlite_sequence WHERE name = '{$this->table}'");
        // 3. Volvemos a sembrar los registros predeterminados:
        $now = now();
        DB::table($this->table)->insert([
            ['name' => 'Perro'],
            ['name' => 'Gato'],
            ['name' => 'Loro'],
        ]);
    }
}





// public function all(): array
// {
//     // $rows = DB::select('SELECT id, name FROM species ORDER BY id ASC');

//     // return array_map(function ($row) {
//     //     return (array) $row;
//     // }, $rows);

//    
// }

// public function find(string $id): array
// {
//     // $row = DB::selectOne(
//     //     'SELECT id, name FROM species WHERE id = ?',
//     //     [$id]
//     // );

//     // if (!$row) {
//     //     throw SpeciesNotFoundException::forId($id);
//     // }

//     // return (array) $row;
// }

// public function create(array $data): array
// {
//     DB::insert(
//         'INSERT INTO species (name) VALUES (?)',
//         [$data['name']]
//     );

//     $result = DB::selectOne('SELECT last_insert_rowid() AS id');
//     $id = (string) $result->id;

//     return $this->find($id);
// }

// public function update(string $id, array $data): array
// {
//     $this->find($id);

//     DB::update(
//         'UPDATE species SET name = ? WHERE id = ?',
//         [
//             $data['name'],
//             $id
//         ]
//     );

//     return $this->find($id);
// }

// public function delete(string $id): bool
// {
//     $this->find($id);

//     $affected = DB::delete(
//         'DELETE FROM species WHERE id = ?',
//         [$id]
//     );

//     return $affected > 0;
// }

// public function reset(): void
// {
//     #vacía la tabla
//     DB::statement('DELETE FROM species');
//     #reiniciar coso
//     DB::statement("DELETE FROM sqlite_sequence WHERE name = 'species'");
// }
