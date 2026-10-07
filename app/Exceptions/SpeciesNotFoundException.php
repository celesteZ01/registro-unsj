<?php

namespace App\Exceptions;

use Exception;

class SpeciesNotFoundException extends Exception
{
        public static function forId(string $id): self
    {
        return new self("No existe especie con ID: {$id}");
    }
}