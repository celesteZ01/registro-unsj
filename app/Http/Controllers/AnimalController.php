<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnimalController extends Controller
{
    #obtener la lista de animales desde la sesión
    private function getAnimales()
    {
        return session()->get('animales', []);
    }

    #guardar la lista de animales en la sesión
    private function setAnimales($animales)
    {
        session()->put('animales', $animales);
    }

    #GET: Listado de animales
    public function index()
    {
        $animales = $this->getAnimales();
        return view('animales.index', compact('animales'));
    }

    #GET: Formulario de creación
    public function create()
    {
        return view('animales.create');
    }

    #POST: Guardar nuevo animal
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:50',
            'especie' => 'required|string|max:50',
            'edad' => 'required|numeric|min:0'
        ]);

        $animales = $this->getAnimales();

        #enerar un ID único aut
        $nuevoId = empty($animales) ? 1 : max(array_column($animales, 'id')) + 1;

        $nuevoAnimal = [
            'id' => $nuevoId,
            'nombre' => $request->nombre,
            'especie' => $request->especie,
            'edad' => $request->edad
        ];

        $animales[] = $nuevoAnimal;
        $this->setAnimales($animales);

        return redirect()->route('animales.index')->with('success', 'Animal agregado exitosamente.');
    }

    #GET: formulario de edición
    public function edit($id)
    {
        $animales = $this->getAnimales();
        $animal = collect($animales)->firstWhere('id', (int)$id);

        if (!$animal) {
            return redirect()->route('animales.index')->with('error', 'Animal no encontrado.');
        }

        return view('animales.edit', compact('animal'));
    }

    #PUT: actualizar animal existente
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:50',
            'especie' => 'required|string|max:50',
            'edad' => 'required|numeric|min:0'
        ]);

        $animales = $this->getAnimales();
        $id = (int)$id;

        foreach ($animales as &$animal) {
            if ($animal['id'] === $id) {
                $animal['nombre'] = $request->nombre;
                $animal['especie'] = $request->especie;
                $animal['edad'] = $request->edad;
                break;
            }
        }

        $this->setAnimales($animales);

        return redirect()->route('animales.index')->with('success', 'Animal actualizado correctamente.');
    }

    #DELETE: eliminar animal
    public function destroy($id)
    {
        $animales = $this->getAnimales();
        $id = (int)$id;

        $animales = array_filter($animales, function ($animal) use ($id) {
            return $animal['id'] !== $id;
        });

        #re indexar el arreglo
        $this->setAnimales(array_values($animales));

        return redirect()->route('animales.index')->with('success', 'Animal eliminado correctamente.');
    }
}