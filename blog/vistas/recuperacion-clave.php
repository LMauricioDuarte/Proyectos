<?php

include_once 'app/repositorioRecuperacionClave.inc.php';

Conexion::openConection();

if(RepositorioRecuperacionClave::url_secreta_existe(Conexion::getConection(), $url_personal)){
    $id_usuario = RepositorioRecuperacionClave::obtener_id_usuario_mediante_url_secreta(Conexion::getConection(), $url_personal);
} else {
    echo'404';
}

if(isset($_POST['guardar-clave'])){
    // MINIMO  DE CARACTERES, LETRA MAYUS Y MINUS, SIGNOS RAROS(%&$)
    //COMPROBAR SI LA CLAVE 2 COINCIDE
    
    // convertir en transaccion
    $clave_cifrada = password_hash($_POST['clave'], PASSWORD_DEFAULT);
    $clave_actualizada = RepositorioUsuarios::actualizar_password(Conexion::getConection(), $id_usuario, $clave_cifrada);
    //eliminar solicitud de recuperacion de contraseña
    
    //redirigir a notifiacion de actualizacion correcta y ofrecer link a login 
    if ($clave_actualizada){
        //redireccion, nueva ventana que sea ya se confirmo
    }else{
       //informar error
    }
}

Conexion::closeConection();

$titulo = 'Recuparacion de contraseña';

include_once 'plantillas/navbar.inc.php';
include_once 'plantillas/documento-declaracion.inc.php';




include_once 'plantillas/panel_control_cierre.inc.php';
include_once 'plantillas/documento-cierre.inc.php';
?>

<div class="container">
    <div class="row">
        <div class="col-md-3">
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    <h4>Crea una nueva contraseña</h4>
                </div>
                <div class="card-body">
                    <form role="form" method="post" action="<?php echo RUTA_RECUPERACION_CLAVE . "/" . $url_personal; ?>">
                        <br>
                        <div class="form-group">
                            <label for="clave">Nueva contraseña</label>
                            <input type="password" name="clave" id="clave" class="form-control" placeholder="Mínimo 6 caracteres" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="clave2">Escribe de nuevo la contraseña</label>
                            <input type="password" name="clave2" id="clave2" class="form-control" placeholder="Debe coincidir" required>
                        </div>
                        
                        <button type="submit" name="guardar-clave" class="btn btn-lg btn-primary btn-block">
                            Guardar Contraseña
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>