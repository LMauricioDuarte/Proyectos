<?php

class Redireccion{
    public static function redirigir($url){ //url = unique resource location
        header('Location: ' . $url, true, 301); 
        die();
    }
}

?>
