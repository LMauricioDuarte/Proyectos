<div class="row">
    <div class="col-md-12">
        <hr>
        <h3>Otras entradas interesantes</h3>
    </div>

<?php
include_once 'app/entrada.inc.php';
include_once 'app/escritorEntradas.inc.php';
    for ($i = 0; $i < count($entradas_al_azar); $i++){
        $entrada_actual = $entradas_al_azar[$i];
    
?>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <?php echo $entrada_actual -> getTitulo(); ?>
            </div>
                <div class="card-body">
                    <p>
                     <?php 
                         echo EscritorEntradas::resumir_texto(nl2br($entrada_actual -> getTexto())); 
                     ?>
                    </p>
                </div>
        </div>
    </div>

<?php    
    }
?>
    <div class="col-md-12">
        <hr>
    </div>
</div>



