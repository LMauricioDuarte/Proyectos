<?php

include_once 'app/usuarios.inc.php';

class RepositorioUsuarios{
    
    public static function obtener_todos($conexion){
        /*guardamos en una variable un array, esto nos devolvera toda la lista de la consulta*/
        $usuarios = array();
        /*Vemos si conexion se ha iniciado y si se puede usar*/
        if(isset($conexion)){
            try{
                include_once 'usuarios.inc.php';
                
                $sql = "select * from usuarios";
                
                /*creamos una variable secuencia y le pasamos la consulta sql que hicimos, el prepare usamos para seguridad, porque se puede poner carecteres especiales cuando cargas el usuario y muestra la bd o le permite gestionar la bd entonces al poner prepare ya anulamos eso*/
                $sentencia = $conexion -> prepare($sql);
                $sentencia -> execute();/*ejecutamos la sentencia preparada arriba*/
                /*Le pedimos que nos devuelva todo los resultados existenes, fetchAll es un array */
                $resultado = $sentencia -> fetchAll();
                
                /*este metodo count nos dice cuantas cosas hay en un array*/
                if(count($resultado)){
                    /*con foreach recorremos todo el array automaticamente, le indicamos el array que va recorrer en este caso $resultado, indicamos como se va llamar el indice, en este caso $fila*/
                    foreach($resultado as $fila){
                        $usuarios[] = new Usuarios(
                            $fila['id_usuario'], $fila['nombre'], $fila['email'], $fila['c_password'], $fila['fecha_registro'], $fila['activo']
                        );
                         
                    }
                }else{
                    print 'No hay usuarios';
                }
            } catch (PDOException $ex) {
                print "Error" . $ex -> getMessage();
            }
            
        }
        return $usuarios;
    }
    
    public static function obtener_numero_usuarios($conexion){
        $total_usuarios = null;
        
        if(isset($conexion)){
            try{
                $sql = "select count(*) as total from usuarios";
                $sentencia= $conexion -> prepare($sql);
                $sentencia -> execute();
                $resultado = $sentencia -> fetch();
                
                $total_usuarios = $resultado['total'];
            } catch (Exception $ex) {
                 print "Error" . $ex -> getMessage();
            }            
        }
        return $total_usuarios;
    }
    
    public static function insertar_usuario($conexion, $usuarios){
        $userName = $usuarios -> getNombre();
        $usuario_insertado = FALSE;
        
        if (isset($conexion)){
            try{
                $sql = "INSERT INTO usuarios(nombre,email,c_password,fecha_registro,activo)
                        VALUES (:nombre, :email, :c_password, NOW(), 0)";/* USAMOS ALIAS ":NOMBRE" PARA QUE PDO PUEDA UTILIZARLO*/
                $sentencia = $conexion -> prepare($sql);
                /* Y LUEGO USAMOS bindparam para atar parametros*/
                $sentencia -> bindParam(':nombre' , $userName , PDO::PARAM_STR); /* PDO  PARAM STR PARA QUE SEA STRING*/
                $sentencia -> bindValue(':email' , $usuarios -> getEmail(), PDO::PARAM_STR);
                $sentencia -> bindValue(':c_password' , $usuarios -> getC_password(), PDO::PARAM_STR);
                
                
                
                $usuario_insertado = $sentencia -> execute();
                
                
            } catch (PDOException $ex) {
                print 'Error' . $ex->getMessage();
            }
            
            
        }
        
        return $usuario_insertado;
    }
    //validar si ya existe el nombre en la base
    public static function nombre_existe($conexion,$nombre){
        $nombre_existe = true;
        
        if (isset($conexion)){ //comprobamos conexion
            try{
                $sql = "SELECT * FROM usuarios WHERE nombre = :nombre";
                
                $sentencia = $conexion -> prepare($sql);
                //INSERTAMOS EL PARAMETRO EN NOMBRE usando bindparam
                $sentencia -> bindParam(':nombre', $nombre,PDO::PARAM_STR);
                $sentencia -> execute();
                $resultado = $sentencia -> fetchAll(); //recuperamos todos los resultados con el fetchAll
                //contamos los resultados y vemos si el nombre ya esta en la bd, si no esta le inserta
                if(count($resultado)){
                    $nombre_existe = true;
                } else {
                    $nombre_existe= false;
                }
                
            } catch (PDOException $ex) {
                print 'Error' . $ex->getMessage();
            }
        }
        
        return $nombre_existe;
    }
    
        public static function email_existe($conexion,$email){
        $email_existe = true;
        
        if (isset($conexion)){
            try{
                $sql = "SELECT * FROM usuarios WHERE email = :email";
                
                $sentencia = $conexion -> prepare($sql);
                
                $sentencia -> bindParam(':email', $email,PDO::PARAM_STR);
                $sentencia -> execute();
                $resultado = $sentencia -> fetchAll(); 
                
                if(count($resultado)){
                    $email_existe = true;
                } else {
                    $email_existe= false;
                }
                
            } catch (PDOException $ex) {
                print 'Error' . $ex->getMessage();
            }
        }
        
        return $email_existe;
    }
    
    public static function obtener_usu_email($conexion, $email){
        $usuarios = null;
        
        if (isset($conexion)){
            include_once 'usuarios.inc.php';
            try {
                $sql = "SELECT * FROM usuarios  WHERE email = :email";
                
                $sentecia = $conexion -> prepare($sql);
                
                $sentecia -> bindParam(':email', $email, PDO::PARAM_STR);
                
                $sentecia -> execute();
                
                $resultado = $sentecia -> fetch();
                
                if(!empty($resultado)){
                    $usuarios = new Usuarios($resultado['id_usuario'],
                            $resultado['nombre'],
                            $resultado['email'],
                            $resultado['c_password'],
                            $resultado['fecha_registro'],
                            $resultado['activo']);
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex -> getMessage();
            }
        }
        
        return $usuarios;
    }
    
    public static function obtener_usu_id($conexion, $id){
        $usuarios = null;
        
        if (isset($conexion)){
            include_once 'usuarios.inc.php';
            try {
                $sql = "SELECT * FROM usuarios  WHERE id_usuario = :id_usuario";
                
                $sentecia = $conexion -> prepare($sql);
                
                $sentecia -> bindParam(':id_usuario', $id, PDO::PARAM_STR);
                
                $sentecia -> execute();
                
                $resultado = $sentecia -> fetch();
                
                if(!empty($resultado)){
                    $usuarios = new Usuarios($resultado['id_usuario'],
                            $resultado['nombre'],
                            $resultado['email'],
                            $resultado['c_password'],
                            $resultado['fecha_registro'],
                            $resultado['activo']);
                }
            } catch (PDOException $ex) {
                print 'ERROR' . $ex -> getMessage();
            }
        }
        
        return $usuarios;
    }
    
    public static function actualizar_password($conexion, $id_usuario, $nueva_clave){
        $actualizacion_correcta = false;
        
        if(isset($conexion)){
            try{
                $sql = "UPDATE usuarios SET password = :password WHERE id = :id";
                
                $sentencia = $conexion -> prepare($sql);
                
                $sentencia -> bindParama(':password', $nueva_clave, PDO::PARAM_STR);
                $sentencia -> bindParama(':id', $id_usuario, PDO::PARAM_STR);
                
                $sentencia -> execute();
                
                $resultado = $sentencia -> rowCount();
                
                
                if(array(count($resultado))){
                    $actualizacion_correcta = true;
                }else{
                    $actualizacion_correcta = false;
                }
                
            } catch (PDOException $ex) {
                print 'ERROR' . $ex -> getMessage();
            }
        }
        
        return $actualizacion_correcta;
    }
    
    
}
