<?php

namespace App\Services;

use App\Contracts\SpeciesServiceInterface;
use App\Exceptions\SpeciesNotFoundException;

class SpeciesMockService implements SpeciesServiceInterface
{
    protected string $sessionKey = 'species_mock_data'; # si le quisiera cambiar el nombre, lo hago desde acá y listo en cambio en sessionAnimal lo tendría que cambiar en cada método que nombro 'animales'
    protected array $defaultSpecies = [
        '1' => ['id' => '1', 'name' => 'Perro'],
        '2' => ['id' => '2', 'name' => 'Gato'],
        '3' => ['id' => '3', 'name' => 'Loro'],
    ];

    public function __construct()
    {
        if (!session()->has($this->sessionKey) || empty(session()->get($this->sessionKey))) { #(si la clave no existe O si existe pero está vacía) empty la clave si existe en la sesión pero no tiene datos
            $this->reset();
        }
    }

    public function all(): array
    {
        return session()->get($this->sessionKey, []);
    }

    public function find(string $id): ?array
    {
        $items = $this->all();

        if (!isset($items[$id])) {
            throw SpeciesNotFoundException::forId($id);
        }

        return $items[$id];
    }

    public function create(array $data): array
    {
        $items = $this->all();
        $newId = (string) (count($items) > 0 ? max(array_keys($items)) + 1 : 1);
        
        $item = ['id' => $newId, 'name' => $data['name']];
        $items[$newId] = $item;
        
        session([$this->sessionKey => $items]);
        return $item;
    }

    public function update(int|string $id, array $data): ?array
    {
        $items = $this->all();
        $id = (string) $id;

        if (!isset($items[$id])) {
            throw SpeciesNotFoundException::forId($id);
        }

        $items[$id] = ['id' => $id, 'name' => $data['name']];
        session([$this->sessionKey => $items]);

        return $items[$id];
    }

    public function delete(int|string $id): bool
    {
        $items = $this->all();
        $id = (string) $id;

        // Corregido: antes decía !isset($animal[$id])
        if (!isset($items[$id])) {
            throw SpeciesNotFoundException::forId($id);
        }

        unset($items[$id]);
        session([$this->sessionKey => $items]);

        return true;
    }

    public function reset(): void{
        session()->put($this->sessionKey, $this->defaultSpecies); #las especies por defecto se quedan incluso con el reset(? a menos que las elimine.
        #session()->forget($this->sessionKey);
    }
}