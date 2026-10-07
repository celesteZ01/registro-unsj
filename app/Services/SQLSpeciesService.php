<?php

namespace App\Services;

use App\Contracts\SpeciesServiceInterface;
use App\Exceptions\SpeciesNotFoundException;
use Illuminate\Support\Facades\DB;

class SQLSpeciesService implements SpeciesServiceInterface
{
    public function all(): array
    {
        $rows = DB::select('SELECT id, name FROM species ORDER BY id ASC');

        return array_map(function ($row) {
            return (array) $row;
        }, $rows);
    }

    public function find(string $id): array
    {
        $row = DB::selectOne(
            'SELECT id, name FROM species WHERE id = ?',
            [$id]
        );

        if (!$row) {
            throw SpeciesNotFoundException::forId($id);
        }

        return (array) $row;
    }

    public function create(array $data): array
    {
        DB::insert(
            'INSERT INTO species (name) VALUES (?)',
            [$data['name']]
        );

        $result = DB::selectOne('SELECT last_insert_rowid() AS id');
        $id = (string) $result->id;

        return $this->find($id);
    }

    public function update(string $id, array $data): array
    {
        $this->find($id);

        DB::update(
            'UPDATE species SET name = ? WHERE id = ?',
            [
                $data['name'],
                $id
            ]
        );

        return $this->find($id);
    }

    public function delete(string $id): bool
    {
        $this->find($id);

        $affected = DB::delete(
            'DELETE FROM species WHERE id = ?',
            [$id]
        );

        return $affected > 0;
    }

    public function reset(): void
    {
        #vacía la tabla
        DB::statement('DELETE FROM species');
        #reiniciar coso
        DB::statement("DELETE FROM sqlite_sequence WHERE name = 'species'");
    }
}