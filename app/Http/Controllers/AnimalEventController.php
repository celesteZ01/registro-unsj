<?php

namespace App\Http\Controllers;

use App\Contracts\AnimalEventServiceInterface;
use Illuminate\Http\Request;

class AnimalEventController extends Controller
{
    public function __construct(
        protected AnimalEventServiceInterface $animalEventService
    ) {}

    /**
     * Registra un nuevo evento para el animal.
     */
    public function store(Request $request, string $animalId)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'date'        => 'required|date',
        ]);

        $validated['animal_id'] = $animalId;

        $this->animalEventService->create($validated);

        return redirect()->route('animales.show', $animalId)
            ->with('success', 'Evento registrado con éxito.');
    }

    /**
     * Elimina un evento registrado.
     */
    public function destroy(string $animalId, string $eventId)
    {
        $this->animalEventService->delete($eventId);

        return redirect()->route('animals.show', $animalId)
            ->with('success', 'Evento eliminado con éxito.');
    }
}