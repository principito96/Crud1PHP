<?php
namespace Clases;
use PDO;
use PDOException;

class Conexion{
    protected static $conexion;

    public function __construct()
    {
        if(self::$conexion==null){
            self::crearConexion();
        }
    }
    public static function crearConexion(){
        $opciones=parse_ini_file('../.config');
        $mibase=$opciones["bbdd"];
        $miUser=$opciones["usuario"];
        $miPass=$opciones["pass"];
        $miHost=$opciones["host"];
        $dns="mysql:host=$miHost;dbname=$mibase;charset=utf8mb4";
        try {
            self::$conexion=new PDO($dns,$miUser,$miPass);
            self::$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $ex) {
            die("Error al conectar a la BBDD,mensaje".$ex->getMessage());
        }
    }
}