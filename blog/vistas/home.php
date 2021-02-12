<?php
include_once 'app/conexion.inc.php';
include_once 'app/repositorioUsuario.inc.php';
include_once 'app/escritorEntradas.inc.php';
/* usamos conexion:: porque accedemos de otra clase, solo si estamos en la misma clase de coexion usamos self::
  conexion::openConection();
  traemos el array de repositorios usuario
  $usuarios = RepositorioUsuarios::obtener_todos(conexion::getConection());
  print("Usuarios Registrados");
  echo count($usuarios);

  conexion::closeConection(); */
$titulo = "Blog";
include_once 'plantillas/documento-declaracion.inc.php';
include_once 'plantillas/navbar.inc.php';

?>

<div class= "container"><!-- hace que se vea justificado el contido que hay adentro de el, osea le deja mas en el medio -->
    <div class="jumbotron mt-3"> <!--  el jumbotron hace que la letra sea grande y salga un marco de fondo y alrededor-->                 
        <h1>Blog De Mauricio</h1>
        <p>
            Blog dedicado a la programación y desarrollo
        </p>
    </div>                                    <!-- rows son las filas-->
</div>                                     <!-- col md es el tamaño que va ocupar en la fila -->

<div class="container">
    <div class="row"><!-- row indica una fila, osea pongo un row y se va para abajo, que seria la siguiente fila-->
        <div class="col-md-4"><!-- cool es el tamaños que va ocupar en la pantalla -->
            <div class="row">
                <div class="col-md-12">                                                                                                                                                      
                    <div class="card"> <!-- ES PARA QUE DÉ FORMA EN LA BUSQUEDA EL CUADRITO-->
                        <div class="card-header">
                            <i class="fas fa-search"></i>
                            Busqueda                                            
                        </div>
                        <div class="card-body"><!-- Para que todo esté adentro de panel busquda-->
                            <form role="form" method="post" action="<?php echo RUTA_BUSCAR; ?>">
                                <div class="form-group"> <!-- para ordenar la lista -->
                                    <input class="form-control" name="termino-buscar" type="search" placeholder="¿Que buscas?">
                                </div>
                                <button type="submit" name="buscar" class="form-control btn btn-primary">Buscar</button>
                            </form>
                        </div>    
                    </div>
                </div>          
            </div>    
         <p><div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">  
                            <i class="fas fa-filter"></i>
                            Filtro                                            
                        </div>
                        <div class="card-body"><!-- Para que todo esté adentro de panel busquda-->
                            no hay nada todavia
                        </div> 
                    </div>    
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <p><div class="card">
                        <div class="card-header">  
                            <i class="fas fa-archive"></i>
                            Archivo                                            
                        </div>
                        <div class="card-body"><!-- Para que todo esté adentro de panel busquda-->
                            no hay nada todavia
                        </div> 
                    </div>    
                </div>
            </div>    
        </div>    
        <div class="col-md-8">
            <?php  
            EscritorEntradas::escribir_entradas();
            ?>
        </div>
    </div>
</div>
<?php
include_once 'plantillas/documento-cierre.inc.php';
?>

