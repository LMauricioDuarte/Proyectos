<?php

class RepositorioRecuperacionClave{
    
    public static function generar_peticion($conexion, $id_usuario, $url_secreta){
        $peticion_generada = false;
        
        if (isset($conexion)){
            try{
                
                $sql = "INSERT INTO recuperacion_clave(usuario_id, url_secreta, fecha) VALUES (:usuario_id, :url_secreta, NOW())";
                
                $sentencia = $conexion -> prepare($sql);
                $sentencia -> bindParam(':usuario_id', $id_usuario, PDO::PARAM_STR);
                $sentencia -> bindParam(':url_secreta', $url_secreta, PDO::PARAM_STR);
                
                $peticion_generada = $sentencia -> execute();
                
            } catch (PDOException $ex) {
                print  'ERROR' . $ex -> getMessage();
            }
        }
        return $peticion_generada;
    } 
    
    public static function url_secreta_existe($conexion,$url_secreta){
        $url_existe = false;
        
        if (isset($conexion)){ //comprobamos conexion
            try{
                $sql = "SELECT * FROM recuperacion_clave WHERE url_secreta = :url_secreta";
                
                $sentencia = $conexion -> prepare($sql);
                
                $sentencia -> bindParam(':url_secreta', $url_secreta,PDO::PARAM_STR);
                $sentencia -> execute();
                $resultado = $sentencia -> fetchAll(); //recuperamos todos los resultados con el fetchAll
                
                if(count($resultado)){
                    $url_existe = true;
                } else {
                    $url_existe= false;
                }
                
            } catch (PDOException $ex) {
                print 'Error' . $ex->getMessage();
            }
        }
        
        return $url_existe;
    }
    
        public static function obtener_id_usuario_mediante_url_secreta($conexion,$url_secreta){
        $id_usuario = null;
        
        if (isset($conexion)){ //comprobamos conexion
            try{
                include_once 'recuperacionClave.inc.php';
                
                $sql = "SELECT * FROM recuperacion_clave WHERE url_secreta = :url_secreta";
                
                $sentencia = $conexion -> prepare($sql);
                
                $sentencia -> bindParam(':url_secreta', $url_secreta,PDO::PARAM_STR);
                $sentencia -> execute();
                $resultado = $sentencia -> fetch(); //recuperamos todos los resultados con el fetchAll
                
                if(!empty($resultado)){
                    $id_usuario = $resultado['usuario_id'];
                }
                
            } catch (PDOException $ex) {
                print 'Error' . $ex->getMessage();
            }
        }
        
        return $id_usuario;
    }
    
}