<?php

namespace App\Contracts;

interface SpeciesServiceInterface
{
    public function all(): array;
    public function find(string $id): ?array; #le agregué ? para SpeciesMockService
    public function create(array $data): array;
    public function update(string $id, array $data): ?array;  #le agregué ? para SpeciesMockService
    public function delete(string $id): bool;
    public function reset(): void;
}