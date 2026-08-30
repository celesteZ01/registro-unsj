<?php

//ejemplos de una función simple
function saludo($nombre) {
    return "Hola, " . $nombre . "!";
}

//ejemplos de una función con parámetros opcionales
function calcularArea(float $base, ?float $altura = null) {
    if ($altura === null) {
        $altura = $base;
    }
    return $base * $altura;
}

echo  saludo("Juan") . "\n"; //LLama a la función saludo
echo "Área del rectángulo: " . calcularArea(5, 10) . "\n"; //Llama a la función calcularArea con ambos parámetros
echo "Área del cuadrado:" .calcularArea(4) . "\n"; //Llama a la función calcularArea con un solo parámetro, altura por defecto es 1