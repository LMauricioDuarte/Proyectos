<?php
include_once 'app/config.inc.php';
include_once 'app/conexion.inc.php';

include_once 'app/usuarios.inc.php';
include_once 'app/recuperacionClave.inc.php';
include_once 'app/repositorioRecuperacionClave.inc.php';

include_once 'app/redireccion.inc.php';

function sa($longitud){
    $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $numero_caracteres = strlen($caracteres); 
    $string_aleatorio = '';
    
    for ($i = 0; $i < $longitud; $i++){ /* .= significa que cada vez vamos a y sumando algo envez de sustituir */
        $string_aleatorio .= $caracteres[rand(0, $numero_caracteres - 1)]; /*valores aleatorios para insertar*/
    } /*Caracteres es un string pero le tratamos como un array con []*//*ponemos $numeros caracteres - 1 porque el indice es 0 y va del 0 al 9*/
    
    return $string_aleatorio;
}

if (isset($_POST['enviar_email'])){
   $email = $_POST['email'];
   
   Conexion::openConection();
   
   if (!RepositorioUsuarios::email_existe(Conexion::getConection(), $email)){
       return;
   }
   
   $usuario = RepositorioUsuarios::obtener_usu_email(Conexion::getConection(), $email);
           
   $nombre_usuario = $usuario -> getNombre();
   $string_aleatorio = sa(10);
   
   $url_secreta = hash('sha256', $string_aleatorio . $nombre_usuario); //cadena de 64 caracteres
   
   $petecion_generada = RepositorioRecuperacionClave::generar_peticion(Conexion::getConection(), $usuario -> getId_usuario(), $url_secreta);
   
   Conexion::closeConection();
   
   //si la peticion es correcta, notificar instrucciones
   if($petecion_generada) {
       Redireccion::redirigir(SERVIDOR);
   }
   
   //si la petiicion ha fallado, notificar error
   
}