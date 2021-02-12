<?php
include_once 'app/config.inc.php';
include_once 'app/conexion.inc.php';

include_once 'app/entrada.inc.php';
include_once 'app/repositorioEntrada.inc.php';
include_once 'app/validadorEntrada.inc.php';
include_once 'app/controlSesion.inc.php';
include_once 'app/redireccion.inc.php';

$entrada_publica = 0;
if (isset($_POST['guardar'])){
    Conexion::openConection();
    
    $validador = new ValidadorEntrada($_POST['titulo'], $_POST['url'], htmlspecialchars($_POST['texto']), Conexion::getConection()); // htmlspecialchars = filtra el texto del textarea de forma que cualquier cosa rara (tabulacion, salto de linea, caracter estraxño) php lo filtra y lo adapta para que se puede ver.
    
    if (isset($_POST['publicar']) && $_POST['publicar'] == 'si') {
        $entrada_publica = 1;
    }
    
    if ($validador -> entrada_valida()) {
        if(ControlSesion::sesion_inciada()){
            $entrada = new Entrada('', $_SESSION['id_usuario'], $validador -> obtener_url(), $validador -> obtener_titulo(), $validador -> obtener_texto(), '', $entrada_publica);
            
            $entrada_insertada = repositorioEntrada::insertar_entrada(Conexion::getConection(), $entrada);
            
            if ($entrada_insertada){
                Redireccion::redirigir(RUTA_GESTOR_ENTRADAS);
            }
            
        }else{
            Redireccion::redirigir(RUTA_LOGIN);
        }
        
        Conexion::closeConection();
    }
}


$titulo = "Nueva entrada del blog";

include_once 'plantillas/navbar.inc.php';
include_once 'plantillas/documento-declaracion.inc.php';
?>
<div class= "container"><!-- hace que se vea justificado el contido que hay adentro de el, osea le deja mas en el medio -->
    <div class="jumbotron mt-3"> <!--  el jumbotron hace que la letra sea grande y salga un marco de fondo y alrededor-->                 
        <h1 class="text-center">Nueva Entrada</h1>
    </div>                                    <!-- rows son las filas-->
</div>   

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form class="form-nueva-entrada" method="POST" action="<?php echo RUTA_NUEVA_ENTRADA; ?>">
                <?php 
                    if (isset($_POST['guardar'])){
                        include_once 'plantillas/form_nueva_entrada_validado.inc.php';
                    }else{
                        include_once 'plantillas/form_nueva_entrada_vacio.inc.php';
                    }
                ?>
            </form>
        </div>
    </div>
</div>

<?php
include_once 'plantillas/documento-cierre.inc.php';
