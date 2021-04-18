<?php

namespace Clases;
require '../vendor/autoload.php';
use Faker\Factory;
use Clases\Users;
class Datos{
    public $faker;

    public function __construct($tabla,$cantidad)
    {
        $this->faker=Factory::create('es_ES');
        switch ($tabla) {
            case 'users':
                $this->crearUsuarios($cantidad);
                break;
        }
    }

    public function crearUsuarios($n){
        //creamos un usuario admin
        $usuario = new Users();
        $usuario->borrarTodo();
        $usuario->setNombre("Paco");
        $usuario->setApellidos(("Perez Gil"));
        $usuario->setUsername(("admin"));
        $usuario->setMail(("correo13212312@hotmail.com"));
        $pass=hash('sha256', "secret0");
        $usuario->setPass($pass);
        $usuario->create();
        //creamos el resto 
        for($i=0;$i<=$n;$i++){
            $usuario->setNombre($this->faker->firstName());
            $usuario->setApellidos($this->faker->lastName(). " ".$this->faker->lastName());
            $usuario->setUsername($this->faker->unique()->userName);
            $usuario->setMail($this->faker->unique()->email());
            $usuario->setPass($this->faker->sha256);
            $usuario->create();
        }
        $usuario=null;
    }

}
