<?php

namespace App\Http\Controllers;

use App\Contracts\AnimalOwnerServiceInterface;
use Illuminate\Http\Request;

class AnimalOwnerController extends Controller
{
    public function __construct(
        protected AnimalOwnerServiceInterface $animalOwnerService
    ) {}

    /**
     * Asocia un usuario a un animal.
     */
    public function store(Request $request, string $animalId)
    {
        $validated = $request->validate([
            'user_id' => 'required|integer|exists:users,id',
        ]);

        $this->animalOwnerService->assign($animalId, (string) $validated['user_id']);

        return redirect()->route('animales.show', $animalId)
            ->with('success', 'Dueño asignado correctamente.');
    }

    /**
     * Elimina la asociación entre un animal y un usuario.
     */
    public function destroy(string $animalId, string $userId)
    {
        $this->animalOwnerService->remove($animalId, $userId);

        return redirect()->route('animals.show', $animalId)
            ->with('success', 'Dueño desvinculado con éxito.');
    }

    /**
     * Marca a un usuario como el responsable principal.
     */
    public function setPrimary(string $animalId, string $userId)
    {
        $this->animalOwnerService->setPrimary($animalId, $userId);

        return redirect()->route('animals.show', $animalId)
            ->with('success', 'Responsable principal actualizado.');
    }
}