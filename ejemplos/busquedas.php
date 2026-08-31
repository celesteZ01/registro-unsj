<?php

$personas = [
    [
        "dni" => "11111111",
        "nombre" => "Olivia",
        "edad" => 15,
        "ciudad" => "San Juan"
    ],
    [
        "dni" => "22222222",
        "nombre" => "Juan",
        "edad" => 36,
        "ciudad" => "Córdoba"
    ],
    [
        "dni" => "33333333",
        "nombre" => "María",
        "edad" => 28,
        "ciudad" => "Buenos Aires"

    ]
];

#Tarea1: Crear una función que haga búsqueda secuencial por DNI
function busquedaSecuencialDNI(array $personas, string $dni)
{
    foreach ($personas as $p) {
        if ($p["dni"] === $dni) {
            return $p;
        }
    }
    return null; #si terminó de recorrer y no lo econtró
}
#funciona?
$dniBuscado = "22222222";
$resultado = busquedaSecuencialDNI($personas, $dniBuscado);
if ($resultado !== null) {
    echo "Búsqueda Secuencial por DNI:\n";
    echo "DNI: " . $resultado["dni"] . "\n";
    echo "Nombre: " . $resultado["nombre"] . "\n";
    echo "Edad: " . $resultado["edad"] . "\n";
    echo "Ciudad: " . $resultado["ciudad"] . "\n";
} else {
    echo "Persona con DNI $dniBuscado no encontrada.\n";
}

#Tarea2: Crear una función que haga búsqueda binaria por DNI
function busquedaBinariaDNI(array $personas, string $dni)
{
    #para ordenar el arreglo
    usort($personas, function ($a, $b) {
        return strcmp($a["dni"], $b["dni"]);
    });
    #búsqueda binaria normal.
    $inicio = 0;
    $fin = count($personas) - 1;
    while ($inicio <= $fin) {
        $medio = intdiv($inicio + $fin, 2); #$medio= intval(($inicio + $fin)/2);
        if ($personas[$medio]["dni"] === $dni) {
            return $personas[$medio];
        } elseif ($personas[$medio]["dni"] < $dni) {
            $inicio = $medio + 1;
        } else {
            $fin = $medio - 1;
        }
    }
    return null;
}
#funciona?
$dniBuscado = "33333333";
$resultado = busquedaBinariaDNI($personas, $dniBuscado);
if ($resultado !== null) {
    echo "Búsqueda Binaria por DNI:\n";
    echo "DNI: " . $resultado["dni"] . "\n";
    echo "Nombre: " . $resultado["nombre"] . "\n";
    echo "Edad: " . $resultado["edad"] . "\n";
    echo "Ciudad: " . $resultado["ciudad"] . "\n";
} else {
    echo "Persona con DNI $dniBuscado no encontrada.\n";
}

#Tarea3: Crear una función que haga búsqueda secuencial por nombre
function busquedaSecuencialNombre(array $personas, string $nom)
{
    foreach ($personas as $p) {
        if (strcasecmp($p["nombre"], $nom) === 0) { #strcasecmp compara dos cadenas sin importar mayúsculas o minúsculas
            return $p;
        }
    }
    return null;
}
#funciona?
$nombreBuscado = "Olivia";
$resultado = busquedaSecuencialNombre($personas, $nombreBuscado);
if ($resultado !== null) {
    echo "Búsqueda Secuencial por Nombre:\n";
    echo "DNI: " . $resultado["dni"] . "\n";
    echo "Nombre: " . $resultado["nombre"] . "\n";
    echo "Edad: " . $resultado["edad"] . "\n";
    echo "Ciudad: " . $resultado["ciudad"] . "\n";
} else {
    echo "Persona con nombre $nombreBuscado no encontrada.\n";
}
