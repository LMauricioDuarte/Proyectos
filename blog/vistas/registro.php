<?php
include_once 'app/conexion.inc.php';
include_once 'app/usuarios.inc.php';
include_once 'app/repositorioUsuario.inc.php';
include_once 'app/validadorRegistro.inc.php';
include_once 'app/redireccion.inc.php';
include_once 'app/config.inc.php';

if (isset($_POST['enviar'])){
    conexion::openConection();
    $validador = new validadorRegistro($_POST['nombre'],$_POST['email'],$_POST['clave1'],$_POST['clave2']
            ,conexion::getConection());
    
    if ($validador -> registro_valido()){
        $usuarios = new Usuarios('', $validador-> get_nombre(),$validador-> get_email(),
                password_hash($validador->get_clave(), PASSWORD_DEFAULT),
                '' , '');
        $usuario_insertado = RepositorioUsuarios::insertar_usuario(conexion::getConection(), $usuarios);
        
        if($usuario_insertado){
            Redireccion::redirigir(RUTA_REGISTRO_CORRECTO . '/' . $usuarios -> getNombre());
        }
    }
    
    conexion::closeConection();
}
/* usamos conexion:: porque accedemos de otra clase, solo si estamos en la misma clase de coexion usamos self::
  conexion::openConection();
  traemos el array de repositorios usuario
  $usuarios = RepositorioUsuarios::obtener_todos(conexion::getConection());
  print("Usuarios Registrados");
  echo count($usuarios);

  conexion::closeConection(); */
$titulo = "Registro";
include_once 'plantillas/documento-declaracion.inc.php';
include_once 'plantillas/navbar.inc.php';
?>

<div class= "container">
    <div class="jumbotron mt-3">
        <h1 class="text-center"> Formulario de Registro</h1>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5> Instrucciones </h5>

                </div>


                <div class="card-body text-center">
                    Para unirte al blog de MonoPapa, introduce un nombre de usuario, tu email
                    y una contraseña. El email que escribas debe ser real ya que lo necesitaras
                    para gestionar tu cuenta. Te recomendamos que uses una contraseña que contenga
                    letras minúsculas, mayúsculas, números y símbolos.<br>
                    <br>
                    <a href="#">¿Ya tienes cuenta? </a>
                    <br><br>
                    <a href="#">¿Olvidaste tu contraseña? </a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5> Introduce tus datos </h5>

                </div>
                <div class="card-body text-center"> <!-- method post es para enviar datos con el metodo post, form-group agrupa mejor los campos, form-control hace que aparezca mas estetica el cuadro para llenar datos -->
                    <form role="form" method="post" action="<?php echo RUTA_REGISTRO ?>">
                        <?php
                        if (isset($_POST['enviar'])){
                            include_once 'plantillas/registro_validado.inc.php';
                        } else{
                            include_once 'plantillas/registro_vacio.inc.php';
                        }
                        ?>
                    </form>
                </div>  
            </div>
        </div>

<?php
include_once 'plantillas/documento-cierre.inc.php';
?>

