<?php

include_once 'app/repositorioEntrada.inc.php';
include_once 'app/entrada.inc.php';
include_once 'app/usuarios.inc.php';


class EscritorEntradas{
    public static function escribir_entradas(){
        
        $entradas = repositorioEntrada::obtener_todas_por_fecha_descendiente(Conexion::getConection());
        
        if(count($entradas)){
            foreach($entradas as $entrada){
                self::escribir_entrada($entrada);
            }
        }
    }
    
    public static function escribir_entrada($entrada){
        if(!isset($entrada)){
            return;
        }
        ?>
        <div class="row">
            <div class="col-md-12">              
                <div class="card">
                    <div class="card-header">
                        <?php
                        echo ($entrada -> getTitulo());
                        ?>
                    </div>    
                    <div class="card-body">
                        <p>
                            <strong>
                                <?php
                                echo $entrada -> getFecha();
                                ?>
                            </strong>
                        </p>
                        <div clas="text-justify">
                        <?php
                        echo nl2br(self::resumir_texto($entrada -> getTexto())); /*nl2br metodo de PHP para que se vea separado los parrafos*/
                        ?>
                        </div>
                        <br>
                        <div class="text-right">
                            <a class="btn btn-primary" href="<?php echo RUTA_ENTRADA . '/' . $entrada -> getUrl() ?>" role="button">Seguir leyendo</a>
                        </div>
                    </div>
                </div>    
            </div>
        </div><br> 
        <?php
    }
    
    public static function mostrar_entrada($entrada){
        if(!isset($entrada)){
            return;
        }
        ?>
            <div class="col-md-4">              
                <div class="card">
                    <div class="card-header">
                        <?php
                        echo $entrada -> getTitulo();
                        ?>
                    </div>    
                    <div class="card-body">
                        <p>
                            <strong>
                                <?php
                                echo $entrada -> getFecha();
                                ?>
                            </strong>
                        </p>
                        <div clas="text-justify">
                        <?php
                        echo nl2br(self::resumir_texto($entrada -> getTexto())); /*nl2br metodo de PHP para que se vea separado los parrafos*/
                        ?>
                        </div>
                        <br>
                        <div class="text-right">
                            <a class="btn btn-primary" href="<?php echo RUTA_ENTRADA . '/' . $entrada -> getUrl() ?>" role="button">Seguir leyendo</a>
                        </div>
                    </div>
                </div>    
            </div>
        <?php
    }
    
    public static function mostrar_entradas_busqueda($entrada){
        for ($i = 1; $i <= count(array($entrada)); $i++){
            if($i % 3 == 0){
                ?>
                <div class="row">
                <?php
            }
            
            $entrada = $entrada[$i - 1];
            self::mostrar_entrada($entrada);
                ?>
                </div>
                <?php
        }
         
    }

    
    public static function resumir_texto($texto){
        $longitud_maxima = 400;
        
        $resultado = '';
    
        if(strlen($texto) >= $longitud_maxima){
            /*METODO 1*/
            /*for ($i = 0; $i < $longitud_maxima; $i++){
                $resultado .= substr($texto, $i,1); Ponemos 1 porque solo queremos un caracter por vez / o indice 
            }*/
            /*METODO 2*/
            $resultado = substr($texto, 0, $longitud_maxima); /* el 0 es empezando desde el caracter 0 */
            
            $resultado .= '...';
            
            //$resultado .="chupala"; le puedo concatenar todo lo que quiero xD
        }else{
            $resultado = $texto;
        }
        
        return $resultado;
    }           
    
}
