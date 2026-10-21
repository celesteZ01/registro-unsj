<?php

namespace App\Contracts;

interface AnimalServiceInterface #servicio a través de una interfaz
{
    public function all(): array; #devuelve una lista con todos los animales
    public function find(int|string $id): ?array; #busca un animal por su ID → devuelve los datos o [null(?)]
    public function create(array $data): array; #recibe los datos del form y registra un nuevo animal
    public function update(int|string $id, array $data): bool; #modifica un animal existente
    public function delete(int|string $id): bool; #busca un animal por si ID y lo borra
    public function reset(): void; #limpia o reinicia info (testsss?)
}

#diap 28
#nota: AnimalController → atiende las peticiones web | AnimalServiceInterface → maneja los datos
