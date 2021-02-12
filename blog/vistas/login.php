<?php
include_once 'app/config.inc.php';
include_once 'app/conexion.inc.php';
include_once 'app/repositorioUsuario.inc.php';
include_once 'app/validadorLogin.inc.php';
include_once 'app/controlSesion.inc.php';
include_once 'app/redireccion.inc.php';


if (ControlSesion::sesion_inciada()){
    Redireccion::redirigir(SERVIDOR);
}

if (isset($_POST['login'])){
    Conexion::openConection();
    
    $validador = new ValidadorLogin($_POST['email'], $_POST['clave'], Conexion::getConection());
    
    if ($validador -> obtener_error() === '' && !is_null($validador -> obtener_usuario())){
        ControlSesion::iniciar_sesion(
                $validador -> obtener_usuario() -> getId_usuario() ,
                $validador -> obtener_usuario() -> getNombre());
        Redireccion::redirigir(SERVIDOR);
    }
    
    
    conexion::closeConection();
    
}

$titulo= 'Login';
include_once 'plantillas/documento-declaracion.inc.php';
include_once 'plantillas/navbar.inc.php';
?>  




<div class="container">
   <br><div class="row">
        <div class="col-md-3">
        </div>
        <div class="col-md-6">
            <div class="card ">
                <div class="card-header text-center">
                    <h4>Iniciar Sesion</h4>
                </div>
                <div class="card-body">
                    <form role="form" method="post" action="<?php echo RUTA_LOGIN ?> ">
                        <h2>Introduce tus datos</h2>
                        <br>
                        <label for="email" class="sr-only">Email</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Email"  autofocus
                               <?php
                                if ( isset($_POST['login']) && isset($_POST['email']) && !empty($_POST['email']) ){
                                    echo 'value="'. $_POST['email'] . '"';
                                }
                               ?>
                        >
                        <br>
                        <label for="clave" class="sr-only">Contraseña</label>
                        <input type="password" name="clave" id="clave" class="form-control" placeholder="Contraseña" ><br>
                        <button type="submit" name="login" class="btn btn-lg btn-primary btn-block">
                            Iniciar Sesion
                        </button>
                       
                    </form>
                    
                    <br>
                    <div class="text-center">
                    <?php
                        if (isset($_POST['login'])) {
                            $validador -> mostrar_error();
                        }
                    ?>
                        <a href="<?php echo RUTA_RECUPERAR_CLAVE ?>">¿Olvidaste tu contraseña?</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include_once 'plantillas/documento-cierre.inc.php';
?>

