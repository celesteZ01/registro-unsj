<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Contracts\AnimalServiceInterface;
use App\Contracts\AnimalEventServiceInterface;
use App\Contracts\UserServiceInterface;

class AnimalEventSeeder extends Seeder
{
    public function __construct(
        protected AnimalServiceInterface $animalOwnerService,
        protected UserServiceInterface $userService,
        protected AnimalEventServiceInterface $animalEventService
    ) {
    }
    public function run(): void
    {
        $empleados = $this->userService->employee();
        $mascotas = $this->animalOwnerService->all();

        #lógica para sembrar datos de eventos de animales
        $this->animalEventService->reset();

        $eventos = [];

        foreach ($mascotas as $mascota) {
            $mascotaId = $mascota['id'];
            #$dueños = $this->animalOwnerService->getOwners($mascotaId);

            #generar un numero aleatorio de eventos para cada mascota
            for ($i = 0; $i < rand(1, 5); $i++) {
                $empleadoId= $empleados[rand(0, \count($empleados) - 1)]['id'];
                $eventos[] = [
                    'animal_id' => $mascotaId,
                    'user_id' => $empleadoId, 
                    'event_date' => now()->subDays(rand(0, 30)),
                    'event_type' => ['consulta', 'vacunación', 'tratamiento', 'cirugía', 'laboratorio', 'hospitalización', 'venta', 'otro'][rand(0, 7)],
                    'description' => "Evento de prueba para la mascota con id: $mascotaId",
                    'amount' => rand(5000, 10000),
                ];
            }

        }

        foreach ($eventos as $evento) {

            $this->animalEventService->create($evento);
        }


    }#?
}
