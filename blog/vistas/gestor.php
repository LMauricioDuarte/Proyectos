<?php
include_once 'plantillas/navbar.inc.php';
include_once 'plantillas/documento-declaracion.inc.php';
include_once 'plantillas/panel_control_declaracion.inc.php';
include_once 'app/entrada.inc.php';

//activar gestor actual

switch($gestor_actual){
    case '';
        $cantidad_entradas_activas = repositorioEntrada::contar_entradas_activas_usuario(Conexion::getConection(), $_SESSION['id_usuario']);
        $cantidad_entradas_inactivas = repositorioEntrada::contar_entradas_inactivas_usuario(Conexion::getConection(), $_SESSION['id_usuario']);
        $cantidad_comentarios = repositorioComentario::contar_entradas_comentarios_usuario(Conexion::getConection(), $_SESSION['id_usuario']);
        
        include_once 'plantillas/gestor-generico.inc.php';
        break;
    case 'entradas';
        $array_entradas = repositorioEntrada::obtener_entradas_usuario_fecha_desc(Conexion::getConection(), $_SESSION['id_usuario']);
        
        include_once 'plantillas/gestor-entradas.inc.php';
        break;
    case 'comentarios';
        include_once 'plantillas/gestor-comentarios.inc.php';
        break;
    case 'favoritos';
        include_once 'plantillas/gestor-favoritos.inc.php';
        break;
}

include_once 'plantillas/panel_control_cierre.inc.php';
include_once 'plantillas/documento-cierre.inc.php';