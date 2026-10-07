<?php


namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\AnimalServiceInterface;
use App\Services\FileAnimalService;
use App\Services\SQLAnimalService;
use App\Contracts\SpeciesServiceInterface;
use App\Services\SQLSpeciesService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        # this vincula la interfaz con la implementación de arch plano json
        $this->app->bind(AnimalServiceInterface::class, FileAnimalService::class);

        # this vincula la interfaz con la implementación de base de datos
        $this->app->bind(AnimalServiceInterface::class, SQLAnimalService::class);
        $this->app->bind(SpeciesServiceInterface::class, SQLSpeciesService::class);
    }

   
    public function boot(): void
    {
        //
    }
}
