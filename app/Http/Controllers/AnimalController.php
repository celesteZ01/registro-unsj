<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\AnimalServiceInterface;
use Exception;

class AnimalController extends Controller
{
    public function __construct(
        private AnimalServiceInterface $animalService
    ) {}

    # GET: Listado de animales
    public function index()
    {
        $animales = $this->animalService->all();
        return view('animales.index', compact('animales'));
    }

    # GET: Formulario de creación
    public function create()
    {
        return view('animales.create');
    }

    # POST: Guardar nuevo animal
    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:50',
            'especie' => 'required|string|max:50',
            'edad' => 'required|numeric|min:0'
        ]);

        $this->animalService->create($data);

        return redirect()->route('animales.index')->with('success', 'Animal agregado exitosamente.');
    }

    # GET: Formulario de edición
    public function edit($id)
    {
        try {
            $animal = $this->animalService->find($id);
            return view('animales.edit', compact('animal'));
        } catch (Exception $e) {
            return redirect()->route('animales.index')->with('error', $e->getMessage());
        }
    }

    # PUT: Actualizar animal existente
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:50',
            'especie' => 'required|string|max:50',
            'edad' => 'required|numeric|min:0'
        ]);

        try {
            $this->animalService->update($id, $data);
            return redirect()->route('animales.index')->with('success', 'Animal actualizado correctamente.');
        } catch (Exception $e) {
            return redirect()->route('animales.index')->with('error', $e->getMessage());
        }
    }

    # DELETE: Eliminar animal
    public function destroy($id)
    {
        try {
            $this->animalService->delete($id);
            return redirect()->route('animales.index')->with('success', 'Animal eliminado correctamente.');
        } catch (Exception $e) {
            return redirect()->route('animales.index')->with('error', $e->getMessage());
        }
    }
}