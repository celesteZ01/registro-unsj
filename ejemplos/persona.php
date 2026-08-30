<?php
class Persona {
    private string $nombre;
    private int $edad;

    public function __construct($nombre, $edad) {
        $this->nombre = $nombre;
        $this->edad = $edad;
    }

    public function saludar(){
        return "Hola, mi nombre es " . $this->nombre . " y tengo " . $this->edad . " años. \n";
    }

    public function dentroDe (int $años): int{
        return ($this->edad + $años);
    }
}

$persona = new Persona("Juan", 30 );
echo $persona->saludar();
echo "Dentro de 5 años, tendré {$persona->dentroDe(5)} años \n";