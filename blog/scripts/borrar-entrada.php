<?php
include_once 'app/config.inc.php';
include_once 'app/conexion.inc.php';
include_once 'app/repositorioEntrada.inc.php';
include_once 'app/redireccion.inc.php';

if((isset($_POST['borrar_entrada']))) {
    $id_entrada = $_POST['id_borrar'];
    
    Conexion::openConection();
    
    repositorioEntrada::eliminar_comentarios_entrada(Conexion::getConection(), $id_entrada);
    
    Conexion::closeConection();
    
    Redireccion::redirigir(RUTA_GESTOR_ENTRADAS);
}



