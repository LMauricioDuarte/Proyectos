<?php
include_once 'app/config.inc.php';
include_once 'app/conexion.inc.php';
include_once 'app/repositorioUsuario.inc.php';
include_once 'app/redireccion.inc.php';

/*if (isset($_GET['nombre']) && !empty($_GET['nombre'])) {
    $nombre = $_GET['nombre'];
} else {
    Redireccion:: redirigir(SERVIDOR);
}Sacamos ya que en el index hacemmos esta validacion*/

$titulo = '!Registro correcto!';

include_once 'plantillas/documento-declaracion.inc.php';
include_once 'plantillas/navbar.inc.php'
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-check-circle-o" aria-hidden="true"></i>
                    Registro Correcto

                </div>
                <div class="card-body text-center">
                    <p>¡Gracias por registrarte <b><?php echo $nombre ?>!</b>
                        <br>
                    <p><a href="<?php echo RUTA_LOGIN ?>">Inicia Sesion</a> para comenzar a usar tu cuenta. </p>
                </div>
            </div>
        </div>

    </div>