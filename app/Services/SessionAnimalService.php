<?php

namespace App\Services;

use App\Contracts\AnimalServiceInterface;
use phpDocumentor\Reflection\PseudoTypes\False_;

class SessionAnimalService implements AnimalServiceInterface{

    public function all(): array{
        return session('animales', []);
    }

    public function find(int|string $id): ?array{
        $animal= session('animales'[]);
        return $animal[$id] ?? null;
    }

    public function create(array $data): array{
        $animal= session('animales'[]);
        $newId= uniqid();
        $animal[$newId]= $data;
        session(['animales' => $animal]);
        return ['id'=> $newId] + $data;
    }

    public function update(int|string $id, array $data): ?array{
        $animal= session('animales'[]);
        if (!isset($animal[$id])){
            return null;
        }
        $animal[$id]= $data;
        session(['animales' => $animal]);
        return ['id' => $id] + $data;
    }

    public function delete(int|string $id): bool{
        $animal= session('animales'[]);
        if (!isset($animal[$id])){
            return False;
        }
        unset($animal[$id]);
        session(['animales' => $animal]);
        return true;
    }

    public function reset(): void{
        session()->forget('animales');
    }

}