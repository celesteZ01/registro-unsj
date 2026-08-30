<?php

//ejemplo de arreglo asociativo
#arreglo de arreglos
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
    ]
];

function agregarPersona(array &$personas, array $persona) {
    $personas[]= $persona;
}

function listarPersonas(array $personas) { #pa mostrar los datos 
    foreach ($personas as $persona) {
        echo "DNI:" . $persona["dni"] . "\n"; //Accede al valor asociado a la clave "dni"
        echo "Nombre:" . $persona["nombre"] . "\n"; //Accede al valor asociado a la clave "nombre"
        echo "Edad:" . $persona["edad"] . "\n"; //Accede al valor asociado a la clave "edad"
        echo "Ciudad:" . $persona["ciudad"] . "\n"; //Accede al valor asociado a la clave "ciudad"
        echo "\n"; // Salto de línea para separar cada persona
    }
}

// Llamada a la función para agregar nueva persona la arreglo
agregarPersona($personas, [
    "dni" => "33333333",
    "nombre" => "María",
    "edad" => 28,
    "ciudad" => "Buenos Aires"
]);

#llamada a la función para listar todsa las personas
listarPersonas($personas);