<?php
include_once 'app/config.inc.php';
include_once 'app/conexion.inc.php';

include_once 'app/usuarios.inc.php';
include_once 'app/entrada.inc.php';
include_once 'app/comentario.inc.php';

include_once 'app/repositorioUsuario.inc.php';
include_once 'app/repositorioEntrada.inc.php';
include_once 'app/repositorioComentario.inc.php';
/*Creamos un enrutador que va controlar que archivo segun la rute que se ha insertado*/

/*Recuperamos la URL, parse_url = extrae la informacion de la url como el nombre de servidor, los parametros, la ruta etc y luego lo llena dentro de un array*/
$componentes_url = parse_url($_SERVER['REQUEST_URI']); /*Le pasamos la ruta*//*URL es localizacion y la URI es identificador pero es lo mismo*/ /*EL PARSE_URL hace "aca esta vacio" / blog=1 / "aca esta vacio"*/

$ruta = $componentes_url['path'];/*path es la direccion que parcheamos al www.localhost.blog ej : www.localhost/blog/usuario/Mauricio* ignorando esta parte www.localhost/blog/ */
/*EJEMPLO 0= ''
1 = USUARIO 
2 = Mauricio*/

$partes_ruta = explode("/", $ruta); /*Sirve para romper un String apartir de cierto caracter*/ 
$partes_ruta = array_filter($partes_ruta); /*ARRAY_FILTER reasigna el array a una forma tratada, cualquier indice del array que contenga un indice vacio sera eliminado ese indice sigue existiendo pero apunta a null para arreglar la parte 0 de parse_url*/
$partes_ruta = array_slice($partes_ruta, 0); /*todos los indices vacios del array se eliminan el resultado es que si le pasamos localhost/blog nuestro array solo tendria un espacio que seria el 0 y seria la palabra blog*/

$ruta_eligida = 'vistas/404.php'; 

if($partes_ruta[0] == 'blog'){ /* el 0 seria como www.localhost/blog */
    if (count($partes_ruta) == 1){
        $ruta_eligida = 'vistas/home.php'; /* el 1 seria como http://www.localhost/blog/home.php*/
    } else if (count($partes_ruta) == 2){
        switch($partes_ruta[1]){
            case 'login':
                $ruta_eligida = 'vistas/login.php';
                break;
            case 'logout':
                $ruta_eligida = 'vistas/logout.php';
                break;
            case 'registro':
                $ruta_eligida = 'vistas/registro.php';
                break;
            case 'gestor':
                $ruta_eligida = 'vistas/gestor.php';
                $gestor_actual = '';
                break;
            case 'relleno-dev':
                $ruta_eligida = 'scripts/script-relleno.php';
                break;
            case 'nueva-entrada':
                $ruta_eligida = 'vistas/nueva-entrada.php';
                break;
            case 'borrar-entrada':
                $ruta_eligida = 'scripts/borrar-entrada.php';
                break;
            case 'editar-entrada':
                $ruta_eligida = 'vistas/editar-entrada.php';
                break;
            case 'recuperar-clave':
                $ruta_eligida = 'vistas/recuperar-clave.php';
                break;
            case 'generar-url-secreta':
                $ruta_eligida = 'scripts/generar-url-secreta.php';
                break;
            case 'mail':
                $ruta_eligida = 'vistas/prueba-mail.php';
                break;
            case 'buscar':
                $ruta_eligida = 'vistas/buscar.php';
                break;
        } 
        
      } else if (count($partes_ruta) == 3){
          if ($partes_ruta[1] == 'registro-correcto'){
              $nombre = $partes_ruta[2];
              $ruta_eligida = 'vistas/registro-correcto.php';
          }
      
          if ($partes_ruta[1] == 'entrada'){
          $url = $partes_ruta[2];
          
          Conexion::openConection();
          $entrada = repositorioEntrada :: obtener_entrada_por_url(Conexion::getConection(), $url);
          
            if ($entrada != null){
              $autor = RepositorioUsuarios::obtener_usu_id(Conexion::getConection(), $entrada -> getAutor_id());
              $comentarios = RepositorioComentario::obtener_comentarios(Conexion::getConection(), $entrada -> getId());
              
              $entradas_al_azar = RepositorioEntrada::obtener_entradas_al_azar(Conexion::getConection(), 3) ;
              
              $ruta_eligida = 'vistas/entrada.php';
            }
          }
          if($partes_ruta[1] == 'gestor'){
              switch($partes_ruta[2]){
                case 'entradas';
                    $gestor_actual = 'entradas';
                    $ruta_eligida = 'vistas/gestor.php';
                    break;
                case '';
                case 'comentarios';
                    $gestor_actual = 'comentarios';
                    $ruta_eligida = 'vistas/gestor.php';
                    break;
                case 'favoritos';
                    $gestor_actual = 'favoritos';
                    $ruta_eligida = 'vistas/gestor.php';
                break;
              }
              
              
          }
          if($partes_ruta[1] == 'recuperacion-clave'){
              $url_personal = $partes_ruta[2];
              $ruta_eligida = 'vistas/recuperacion-clave.php';
          }
          
      }
}


include_once $ruta_eligida;

/*if($partes_ruta[2] == 'registro'){
    include_once 'vistas/registro.php';
}else if($partes_ruta[2] == 'login'){
    include_once 'vistas/login.php';
}else if($partes_ruta[1] == 'blog'){
    include_once 'vistas/home.php';
}else {
    echo '404';
}*/ 

