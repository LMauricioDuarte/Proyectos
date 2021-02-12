<div class="row">
    <div class="col-md-12">
        <button class="btn btn-primary form-control" data-toggle="collapse" data-target="#dropdown">
            <?php echo "Ver comentarios (" . count($comentarios) . ")" ?>
        </button>
        <br>
        <br>
        <div id="dropdown" class="collapse">
            <?php
            if(count($comentarios)){
                for ($i=0; $i < count($comentarios); $i++){
                    $comentario = $comentarios[$i];
                    ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <?php echo $comentario -> getTitulo(); ?>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <?php echo $comentario ->getAutor_id(); ?>
                                            </div>
                                            <div class="col-md-10">
                                                <p>
                                                    <?php echo $comentario -> getFecha(); ?>
                                                </p>   
                                                <p>
                                                    <?php echo nl2br($comentario -> getTexto()); ?>
                                                </p>   
                                            </div>
                                        </div> 
                                    </div>        
                                </div>    
                            </div>
                        </div>
                    <?php
                }        
            }else{
                echo 'Todavia no hay comentarios';
            }
                
            ?>
        </div>    
    </div>
</div>    


