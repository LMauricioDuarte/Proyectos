<?php

$titulo= 'Recuperacion de contraseña';
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
                    <h4>Recuperación de contraseña</h4>
                </div>
                <div class="card-body">
                    <form role="form" method="post" action="<?php echo RUTA_CREAR_URL_SECRETA; ?> ">
                        <h2>Introduce tu email</h2>
                        <br>
                        <p>
                            Escribe la dirección de correo electronico con la que te registraste y te enviaremos un email con el que podras restablecer tu contraseña.
                        </p>
                        <label for="email" class="sr-only">Email</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Email"  required autofocus>
                        <br>
                        <button type="submit" name="enviar_email" class="btn btn-lg btn-primary btn-block">
                            Enviar
                        </button>
                       
                    </form>
                    <br>
            </div>
        </div>
    </div>
</div>
<?php
include_once 'plantillas/documento-cierre.inc.php';
?>

