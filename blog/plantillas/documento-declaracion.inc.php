<!DOCTYPE html> <!-- DEFINE EL TIPO DE DOCUMENTO-->
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html lang="es"> <!-- lang="es" es el tipo de lenguaje -->
    <head>
        <?php
        if (!isset($titulo) || empty($titulo)){
            $titulo = "Blog";
        }
        echo "<title>$titulo</title>"
        ?>
        <meta charset="UTF-8"> <!-- para que reconozca los caracteres especiales -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Etiqueta que sirve para internet explorer -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Es para que se adapte a si es celular computadora etc ""initial-scale=1.0-es para que inicie sin zoom""-->

        <link href="<?php echo RUTA_CSS ?>bootstrap.min.css" rel="stylesheet" type="text/css">  <!-- traemos el bootstrap  stylesheet es hoja de estilo, entonces asi le indicamos que es un css,decide la aparencia que van a tener los componentes-->
        <link href="<?php echo RUTA_CSS ?>estilos.css" rel="stylesheet"> <!-- estilos de css -->
        <script src="https://kit.fontawesome.com/628d5d688b.js" crossorigin="anonymous"></script>

    </head>
<body> 