<?php
include_once 'app/config.inc.php';
include_once 'app/conexion.inc.php';

include_once 'app/usuarios.inc.php';
include_once 'app/entrada.inc.php';
include_once 'app/comentario.inc.php';

include_once 'app/repositorioUsuario.inc.php';
include_once 'app/repositorioEntrada.inc.php';
include_once 'app/repositorioComentario.inc.php';

Conexion::openConection();

/*for ($usuarios = 0; $usuarios < 101; $usuarios++){
    $nombre = sa(10);
    $email = sa(5). '@' .sa(3);
    $c_password = password_hash('123456', PASSWORD_DEFAULT);
    
    $usuario = new Usuarios('',$nombre, $email, $c_password, '', '');
    RepositorioUsuarios::insertar_usuario(Conexion::getConection(), $usuario);
}*/

for($entradas = 0; $entradas < 101; $entradas++){
    $titulo = sa(10);
    $texto = lorem();
    $autor_id = rand(113,213);
    $url = sa(15);
    
    $entrada = new Entrada('', $autor_id, $url, $titulo, $texto, '', '');
    repositorioEntrada::insertar_entrada(Conexion::getConection(), $entrada);
}

for($comentarios = 0; $comentarios < 101; $comentarios++){
    $titulo = sa(10);
    $texto = lorem();
    $autor_id = rand(113,213);
    $entrada_id = rand(417,517);
    
    $comentario = new Comentario('', $autor_id, $entrada_id, $titulo, $texto, '');
    repositorioComentario::insertar_comentario(Conexion::getConection(), $comentario);
}



function sa($longitud){
    $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $numero_caracteres = strlen($caracteres); 
    $string_aleatorio = '';
    
    for ($i = 0; $i < $longitud; $i++){ /* .= significa que cada vez vamos a y sumando algo envez de sustituir */
        $string_aleatorio .= $caracteres[rand(0, $numero_caracteres - 1)]; /*valores aleatorios para insertar*/
    } /*Caracteres es un string pero le tratamos como un array con []*//*ponemos $numeros caracteres - 1 porque el indice es 0 y va del 0 al 9*/
    
    return $string_aleatorio;
}

function lorem(){
    $lorem = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis suscipit, orci at tempus ullamcorper, ex dolor aliquam ligula, a ornare lectus enim eget velit. Suspendisse mi diam, aliquet in sem quis, scelerisque mollis metus. Nunc aliquam nulla lorem, a hendrerit massa viverra vitae. Curabitur at leo velit. Integer ac lorem ultrices enim finibus finibus ac quis velit. Integer volutpat a erat eu tristique. Integer mollis, lorem quis placerat porta, est leo tincidunt massa, vitae rutrum nibh risus non mi. Nam tincidunt neque nec purus pulvinar dictum vitae a diam.

Ut eros lectus, malesuada a placerat eu, porttitor sit amet elit. In congue ipsum sapien, vel iaculis velit convallis quis. Cras mollis felis vitae justo semper, luctus venenatis libero lobortis. Vestibulum vulputate feugiat dui quis gravida. Interdum et malesuada fames ac ante ipsum primis in faucibus. Etiam maximus, nibh id sagittis mollis, tellus orci fringilla enim, a venenatis purus mi eu erat. Maecenas tincidunt diam elit, ac posuere nunc ultricies sit amet. Aenean accumsan erat erat, ut interdum neque vestibulum ultricies. Phasellus ut ex eu purus commodo consequat sed sit amet lorem. Nam iaculis leo finibus tortor luctus, et interdum lacus condimentum. Mauris sed justo felis.

Donec consectetur nisl et nisi tempus, eget viverra eros tincidunt. Mauris sit amet odio at ipsum feugiat iaculis ac ut libero. Pellentesque vitae tincidunt erat. Proin id rutrum nulla. Vivamus eros diam, faucibus quis efficitur mattis, consequat eu eros. Praesent ac dolor lacinia, bibendum nibh vel, tincidunt urna. Phasellus vitae metus non magna sagittis ultrices eu et lectus. Aliquam erat volutpat. Nam vehicula iaculis rutrum. Nullam non turpis nec massa accumsan posuere. Quisque non euismod neque.

Praesent egestas ligula nec ipsum iaculis, ut consectetur est consequat. Donec mollis, sapien a facilisis accumsan, diam purus varius magna, sed imperdiet eros eros vitae quam. Vivamus dictum nec magna a varius. Mauris ac tristique purus. Integer dictum vel justo quis dignissim. Nulla tristique a velit a rutrum. Aliquam eu dolor sed erat ultrices posuere. Quisque egestas ante ut mi sagittis placerat vitae vitae lectus. Praesent et dolor risus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec at neque ex. Sed at aliquet leo.

Nam egestas tristique lacus, in efficitur libero lacinia sed. Pellentesque sit amet magna mattis, molestie urna in, accumsan mauris. Sed vitae elit non nunc pharetra vulputate. Nam nec lacus vitae erat cursus congue. Mauris pulvinar hendrerit orci, vitae accumsan felis congue non. Nullam ut rutrum felis, nec tincidunt dui. Aliquam sit amet dui justo. Ut vitae quam odio. In sit amet mi id tortor bibendum tincidunt at sed purus. Mauris non volutpat nisl, eget sollicitudin lorem. Sed vehicula magna et felis pretium, eget euismod ligula fermentum. Morbi pellentesque ipsum et quam consequat pellentesque quis at dolor.' ;

    return $lorem;
    
}





