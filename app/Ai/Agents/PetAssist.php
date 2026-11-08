<?php

namespace App\Ai\Agents;

use Laravel\Ai\Contracts\Conversational;
use Laravel\Ai\Contracts\HasTools;
use Laravel\Ai\Contracts\Tool;
use Laravel\Ai\Messages\Message;
use Laravel\Ai\Providers\Tools\ProviderTool;

use App\Contracts\AnimalEventServiceInterface;
use App\Contracts\AnimalOwnerServiceInterface;
use App\Contracts\AnimalServiceInterface;
use App\Contracts\SpeciesServiceInterface;
use Laravel\Ai\Contracts\Agent;
use Laravel\Ai\Promptable;
use App\Models\User;
use Stringable;

class PetAssist implements Agent #Conversational, HasTools
{
    use Promptable;

    public function __construct(
        protected User $user, # inyecta el usuario que está conectado
        protected AnimalServiceInterface $animalService, #según el usuario, muestra sus mascotas?
        protected SpeciesServiceInterface $speciesService,
        protected AnimalOwnerServiceInterface $animalOwnerService,
        protected AnimalEventServiceInterface $animalEventService,

        ){}

    /**
     * Get the instructions that the agent should follow.
     */
    public function instructions(): Stringable|string
    {
        $prompt = <<<'PROMPT'
            Serás un vendedor de la tienda de mascotas "Pet's Care" y tu objetivo es FIDELIZAR a los clientes, saludarlos amistosamente, preguntarles por sus mascotas, y ofrecerles productos y servicios de la tienda.
            NO DEBES DAR CONSEJOS VETERINARIOS NI DE SALUD, SOLO DE PRODUCTOS Y SERVICIOS DE LA TIENDDA.
            NO INICES UNA CONVERSACIÓN.
            SOLO DEBÉS DAR EL MENSAJE DE SALUDO, OFERTAS Y FIDELZACIÓN, SIN INICIAR NI HACERLE PREGUNTAS AL CLIENTE.
            NO OLVIDES REFERIRTE AL CLIENTE POR SU NOMBRE.
            SE AMIGABLE, CORDIAL, CERCANO, BREVE Y CONCISO.
        PROMPT;

        #esto dsp se comenta, se supone que las rsp deben ser dinámicas
        $prompt .="El nombre del cliente es: {$this->user->name}. \n";
        $prompt .="El email del cliente es: {$this->user->email}. \n";
        $prompt .="El cliente tiene las siguientes mascotas: \n";
        $prompt .="Un perro labrador de tres años llamado Max. \n";
        $prompt .="Un gato siamés de dos años llamado Luna. \n";
        $prompt .="El perro tuvo una intervención quirúrgica hace seis meses y está en proceso de recuperación. \n";

        return $prompt;
    }

    // /**
    //  * Get the list of messages comprising the conversation so far.
    //  *
    //  * @return Message[]
    //  */
    // public function messages(): iterable #conversación con el chatbot 
    // {
    //     return [];
    // }

    // /**
    //  * Get the tools available to the agent.
    //  *
    //  * @return list<Agent|Tool|ProviderTool>
    //  */
    // public function tools(): iterable
    // {
    //     return [];
    // }
}
