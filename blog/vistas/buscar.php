<?php
include_once 'app/escritorEntradas.inc.php';


$busqueda = null;
$resultados = null;

//validar busqueda si esta iniciado
if(isset($_POST['buscar']) && isset($_POST['termino-buscar']) && !empty($_POST['termino-buscar'])) {
    $busqueda = $_POST['termino-buscar'];

    Conexion::openConection();
    $resultados = repositorioEntrada::buscar_entradas_todos_los_campos(Conexion::getConection(), $busqueda);
    
    Conexion::closeConection();
}

$titulo = "Buscar";

include_once 'plantillas/documento-declaracion.inc.php';
include_once 'plantillas/navbar.inc.php';
?>

<div class= "container">
    
        <div class="jumbotron mt-3">
            <h1 class="text-center"> Buscar </h1>
            <br>
            <div class="row">
                <div class="col-md-2">
                </div>
                <div class="col-md-8">
                    <form role="form" method="post" action="<?php echo RUTA_BUSCAR; ?>">
                        <div class="form-group"> <!-- para ordenar la lista -->
                            <input class="form-control" name="termino-buscar" type="search" placeholder="¿Que buscas?" required <?php echo "value='" . $busqueda. "'" ?>>
                        </div>
                            <button type="submit" name="buscar" class="form-control btn btn-primary">Buscar</button>
                    </form>
                </div>
            </div>
        </div>
    
</div>

<div class="container">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">
                <a data-toggle="collapse" href="#avanzada">Busqueda avanzada</a>
            </h4>
        </div>
    </div>
    <div id="avanzada" class="panel-collapse collapse">
        <div class="card-body">
            <form role="form" method="post" action="<?php echo RUTA_BUSCAR  ?>">
                <p>Buscar en los siguientes campos:</p>
                <label class="check-box">
                    <input type="checkbox" value =""> Título
                </label>
                <label class="check-box">
                    <input type="checkbox" value =""> Contenido
                </label>        
                <label class="check-box">
                    <input type="checkbox" value =""> Tags
                </label>    
                <label class="check-box">
                    <input type="checkbox" value =""> Autor
                </label>
                <hr>
                <p class="">Ordenar por:</p>
                <label class="form-check-inline">
                    <input type="radio" name="fecha"> Entradas más recientes
                </label>
                <label class="form-check-inline">
                    <input type="radio" name="fecha"> Entradas más antiguas
                </label>    
                <button type="submit" name="busqueda-avanzada" class="btn btn-primary">
                    Busqueda-avanzada
                </button>
            </form>
        </div>
    </div>
</div>


<div class="container" id="resultados">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h1> 
                    Resultados 
                    <?php 
                    if(count($resultados)){
                      echo '<small>' . count($resultados) . '</small>';
                    }
                    ?>
                </h1>
            </div>
            <?php
            if(count($resultados)){
                EscritorEntradas::mostrar_entradas_busqueda($resultados);
            } else {
                ?>
                <p> No existe coincidencias</p>
                <?php
            }
            ?>
        </div>
    </div>
</div>    

<?php
include_once 'plantillas/documento-cierre.inc.php';
?>
