<?php


namespace App\Providers;

use App\Services\SessionAnimalService;
use Illuminate\Support\ServiceProvider;
use App\Contracts\AnimalServiceInterface;
use App\Services\FileAnimalService;
use App\Services\SQLAnimalService;
use App\Contracts\SpeciesServiceInterface;
use App\Services\SQLSpeciesService;
#use App\Services\SpeciesMockService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        # this vincula la interfaz con la implementación de base de datos
        $this->app->bind(
            AnimalServiceInterface::class, ###cada vez que alguien pida esto
            SQLAnimalService::class); #se le manda una instancia de esto

        $this->app->singleton(
            SpeciesServiceInterface::class,
            SQLSpeciesService::class
        );

        // # this vincula la interfaz con la implementación de arch plano json
        // $this->app->bind(AnimalServiceInterface::class, FileAnimalService::class);

        // $this->app->bind(AnimalServiceInterface::class, SessionAnimalService::class);


        // $this->app->bind(SpeciesServiceInterface::class, SQLSpeciesService::class);

        // #$this->app->singleton(SpeciesServiceInterface::class, SpeciesMockService::class);
    }


    public function boot(): void
    {
        //
    }
}
