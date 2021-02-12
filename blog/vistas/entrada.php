<?php
include_once 'app/config.inc.php';
include_once 'app/conexion.inc.php';

include_once 'app/usuarios.inc.php';
include_once 'app/entrada.inc.php';
include_once 'app/comentario.inc.php';

include_once 'app/repositorioUsuario.inc.php';
include_once 'app/repositorioEntrada.inc.php';
include_once 'app/repositorioComentario.inc.php';

$titulo = $entrada -> getTitulo();

include_once 'plantillas/documento-declaracion.inc.php';
include_once 'plantillas/navbar.inc.php';
?>
<div class="container contenido-articulo">
    <div class="row">
        <div class="col-md-12">
            <h1>
                <?php echo $entrada ->  getTitulo();?>
            </h1>    
        </div>        
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
            <p>
                Por
                <a href="#">
                    <i class="fas fa-user"></i>
                    <?php echo $autor -> getNombre();?>
                </a>
                el
                <?php echo $entrada -> getFecha();?>
            </p>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
            <article class="text-justify">
                <?php echo nl2br($entrada -> getTexto());?>
            </article>
        </div>
    </div>
    <?php
        include_once 'plantillas/entradas_al_azar_inc.php';
    ?>
    <br>
    <?php        
        include_once 'plantillas/comentarios_entrada_inc.php';        
    ?>
</div>
    
<?php
include_once 'plantillas/documento-cierre.inc.php';

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

