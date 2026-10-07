<?php

namespace App\Exceptions;

use Exception;

class AnimalNotFoundException extends Exception
{
        public static function forId(string $id)
    {
        return new self("No existe animal con ID: {$id}");
    }
}