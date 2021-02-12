<?php    
class Conexion{
    /*DIFERENCIA ENTRE REQUIRE Y INCLUDE
      El require si no logra traer lo que le pedimos lanza un error grave y para todo el script en cambio del include intenta agarrar el archivo pero si no lo logra solo lanza una advertencia pero sigue haciendo el resto de las cosas*/
       
    private static $conexion;

    public static function openConection(){
        /*aca abajo le decimos que si la variable $conexion no esta inizializada que
           entre en el try el signo ! es lo que le da la negatividad a la sintaxis*/
        if (!isset(self::$conexion)){
           /*el try es lo que va intentar hacer, y si no logra hacer va entrar en el catch y hacer lo que pongamos en el catch*/
            try {
                include_once 'config.inc.php';
                /*Cuando queramos acceder a una constante o método estático desde dentro de la clase, usamos la palabra reservada: self*/
                self::$conexion = new PDO('mysql:host='.nombre_servidor.'; dbname='.dbname , NOMBRE_USUARIO, PASSWORD);
                self::$conexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);/*configuracion de modos de errores*/                       
                self::$conexion -> exec("SET CHARACTER SET utf8");
            } catch (PDOException $ex) {
                print "Error: " . $ex ->getMessage() . "<br>";
                die();
            }
        }
    }
    
    public static function closeConection(){
        /*aca comprobamos si la conexion esta iniciada, le decimos que cierre la conexion.*/
        if(isset(self::$conexion)){
            self::$conexion = null;          
        }
    }
    /*Esta funcion es para poder utilizar la conexion en otras clases*/
    public static function getConection(){
        return self::$conexion;
    }
}
