<?php


namespace App\Providers;

use App\Services\SessionAnimalService;
use Illuminate\Support\ServiceProvider;
use App\Services\FileAnimalService;
use App\Providers\Auth;
use Illuminate\Support\Facades\Blade;

use App\Contracts\AnimalServiceInterface;
use App\Services\SQLAnimalService;

use App\Contracts\SpeciesServiceInterface;
use App\Services\SQLSpeciesService;

use App\Contracts\UserServiceInterface;
use App\Services\SQLiteUserService;

use App\Contracts\AnimalOwnerServiceInterface;
use App\Services\SQLiteAnimalOwnerService;

use App\Contracts\AnimalEventServiceInterface;
use App\Services\SQLiteAnimalEventService;

#use App\Services\SpeciesMockService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        # this vincula la interfaz con la implementación de base de datos
        #USUARIO
        $this->app->singleton(
            UserServiceInterface::class, #cuando alguien pida la interfaz
            SQLiteUserService::class #ésta es la clase que hay que mandarle
        );

        #ANIMAL
        $this->app->bind(
            AnimalServiceInterface::class, ###cada vez que alguien pida esto
            SQLAnimalService::class #se le manda una instancia de esto 
        ); 

        #SPECIES
        $this->app->singleton(
            SpeciesServiceInterface::class,
            SQLSpeciesService::class
        );

        #OWNER DE ANIMAL
        $this->app->singleton(
            AnimalOwnerServiceInterface::class,
            SQLiteAnimalOwnerService::class
        );

        #EVENT DE ANIMAL
        $this->app->singleton(
            AnimalEventServiceInterface::class,
            SQLiteAnimalEventService::class
        );

        // # this vincula la interfaz con la implementación de arch plano json
        // $this->app->bind(AnimalServiceInterface::class, FileAnimalService::class);

        // $this->app->bind(AnimalServiceInterface::class, SessionAnimalService::class);


        // $this->app->bind(SpeciesServiceInterface::class, SQLSpeciesService::class);

        // #$this->app->singleton(SpeciesServiceInterface::class, SpeciesMockService::class);
    }


    public function boot(): void
    {   #esto es para usar @role() en navigation
        Blade::if('role', function (...$roles) {
            return auth()->check() && \in_array(auth()->user()->role, $roles);
        });
    }
}
