<?php
include_once 'app/config.inc.php';
include_once 'app/conexion.inc.php';

include_once 'app/entrada.inc.php';
include_once 'app/repositorioEntrada.inc.php';
include_once 'app/controlSesion.inc.php';
include_once 'app/redireccion.inc.php';
include_once 'app/validadorEntradaEditada.inc.php';
include_once 'app/validadorEntrada.inc.php';

Conexion::openConection();

if (isset($_POST['guardar_cambios_entrada'])){
    $entrada_publica_nueva = 0;
    if(isset($_POST['publicar']) && $_POST['publicar'] == "si"){
        $entrada_publica_nueva = 1;
    }
    
    $validador = new ValidadorEntradaEditada($_POST['titulo'], $_POST['titulo-original'], $_POST['url'], $_POST['url-original'], htmlspecialchars($_POST['texto']), 
            $_POST['texto-original'], $entrada_publica_nueva, $_POST['publicar-original'], Conexion::getConection());
    
    if(!$validador -> hay_cambios()){
        Redireccion::redirigir(RUTA_GESTOR_ENTRADAS);
    }else{
        
        if ($validador ->entrada_valida()){
            $cambio_efecutado = repositorioEntrada::actualizar_entrada(Conexion::getConection(), $_POST['id_entrada'], $validador -> obtener_titulo(), $validador 
                    -> obtener_url(), $validador -> obtener_texto(), $validador ->obtener_checkbox());
            
            if($cambio_efecutado){
                Redireccion::redirigir(RUTA_GESTOR_ENTRADAS);
            }else{
                echo 'entrada no valida';
            }
        } 
    }

            
}

$titulo = "Editar entrada";

include_once 'plantillas/navbar.inc.php';
include_once 'plantillas/documento-declaracion.inc.php';
?>

<div class= "container"><!-- hace que se vea justificado el contido que hay adentro de el, osea le deja mas en el medio -->
    <div class="jumbotron mt-3"> <!--  el jumbotron hace que la letra sea grande y salga un marco de fondo y alrededor-->                 
        <h1 class="text-center">Editar Entrada</h1>
    </div>                                    <!-- rows son las filas-->
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form class="form-nueva-entrada" method="POST" action="<?php echo RUTA_EDITAR_ENTRADA; ?>">
                <?php
                    if (isset($_POST['editar_entrada'])){
                        $id_entrada = $_POST['id_editar'];
                        
                        
                        $entrada_recuperada = repositorioEntrada::obtener_entrada_por_id(Conexion::getConection(), $id_entrada); 
                        
                        include_once 'plantillas/form_entrada_recuperada.inc.php';
                        
                        Conexion::closeConection();
                        
                    } else if (isset($_POST['guardar_cambios_entrada'])) { 
                        $id_entrada = $_POST['id_entrada'];
                        
                        $entrada_recuperada = repositorioEntrada::obtener_entrada_por_id(Conexion::getConection(), $id_entrada); 
                        
                        include_once 'plantillas/form_entrada_recuperada_validada.inc.php';
                        
                    }
                
                ?>
            </form>
        </div>
    </div>
</div>

<?php
include_once 'plantillas/panel_control_cierre.inc.php';
include_once 'plantillas/documento-cierre.inc.php';
?>