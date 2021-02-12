<?php
include_once 'app/config.inc.php';
include_once 'app/conexion.inc.php';
include_once 'app/comentario.inc.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of repositorioComentario
 *
 * @author Mauricio
 */
class repositorioComentario {
    
    public static function insertar_comentario($conexion, $comentario){
        $comentario_insertado = false;
        
        if (isset($conexion)){
            try{
                $sql = "INSERT INTO comentarios(autor_id,entrada_id,titulo,texto,fecha)
                        VALUES (:autor_id, :entrada_id, :titulo, :texto, NOW())";/* USAMOS ALIAS ":NOMBRE" PARA QUE PDO PUEDA UTILIZARLO*/
                $sentencia = $conexion -> prepare($sql);
                /* Y LUEGO USAMOS bindparam para atar parametros*/
                $sentencia -> bindValue(':autor_id' , $comentario -> getAutor_id(), PDO::PARAM_STR); /* PDO  PARAM STR PARA QUE SEA STRING*/
                $sentencia -> bindValue(':entrada_id' , $comentario -> getEntrada_id(), PDO::PARAM_STR);
                $sentencia -> bindValue(':titulo' , $comentario ->  getTitulo(), PDO::PARAM_STR);
                $sentencia -> bindValue(':texto' , $comentario -> getTexto(), PDO::PARAM_STR);
                
                $comentario_insertado = $sentencia -> execute();
                
                
            } catch (PDOException $ex) {
                print 'Error' . $ex->getMessage();
            }
            
            
        }
        
        return $comentario_insertado;
    }
    
    public static function obtener_comentarios($conexion, $id){
        $comentarios= array();
        
        if(isset($conexion)){
            try{
                include_once 'comentario.inc.php';
                
                $sql = "SELECT * FROM comentarios WHERE id = :id";
                $sentencia = $conexion -> prepare($sql);
                $sentencia -> bindParam(':id', $id, PDO::PARAM_STR);
                $sentencia -> execute();
                
                $resultado = $sentencia -> fetchAll();
                
                if (count($resultado)){
                    foreach ($resultado as $fila){
                        $comentarios[] = new Comentario(
                                $fila['id'], $fila['autor_id'], $fila['entrada_id'], 
                                $fila['titulo'], $fila['texto'], $fila['fecha']
                                );
                    }
                }/*else{
                    print 'Todavia no hay comentarios';
                }*/
                
            } catch (PDOException $ex) {
                print 'Error' . $ex->getMessage();
            }
        }
        
        return $comentarios;
    }
    
    public static function contar_entradas_comentarios_usuario($conexion, $id_usuario){
        $total_comentarios='0';
        
        if(isset($conexion)){
            try{
                $sql = "SELECT COUNT(*) as total_comentarios FROM comentarios WHERE autor_id = :autor_id";
                $sentencia = $conexion -> prepare($sql);
                $sentencia ->bindParam(':autor_id', $id_usuario, PDO::PARAM_STR);
                $sentencia -> execute();
                $resultado = $sentencia -> fetch();
                
                if(!empty($resultado)){
                    $total_comentarios = $resultado['total_comentarios'];
                }
            } catch (PDOException $ex) {
                print 'ERROR: ' .$ex ->getMessage();
            }
        }
        
        return $total_comentarios;
    }
}
