<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; #hace referencia a elementos que va a utilizar de una libreria

class ListarPersonasController extends Controller #extends indica que  ListarPersonaController hereda de Controller
{
    //Retorna un array con los nombres de las personas.
    public function index(){
        $personas=[
            "Juan Perez",
            "Maria Gomez",
            "Carlos Rodriguez",
            "Ana Martinez",
        ];
        return response()->json($personas); #convierte personas en json y lo retorna
    }
}
