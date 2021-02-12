<?php
include_once 'app/controlSesion.inc.php';
include_once 'app/config.inc.php';

conexion::openConection();
$total_usuarios = RepositorioUsuarios::obtener_numero_usuarios(conexion::getConection());
?>
<!-- logotipo de la barra de navegacion --> 
<nav class=" navbar navbar-expand-lg navbar-dark bg-dark"> <!-- nav es para hacer barra de navegacion y class es lo que ponemos en el css y llamamos-->
    <div class="container"> 
        <a class="navbar-brand" href="<?php echo SERVIDOR ?>">Blog De Desarrollo</a> <!--el navb-brand me modifica la oracion monopapa  -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" 
                data-target="#navbarSupportedContent"> <!-- collapse es para que se adapte a la pantalla el boton--><!--hace que se vea un boton, cuando la pantalla sea de celular o se achique-->
            <span class="navbar-toggler-icon" ></span> <!--Despliega el icono para ver la lisa desplegable cuando esta chica la pantalla -->                   
        </button>     <!-- data-toogle=collapse es para que no se vea la barra cuando sea muy chica -->

        <!--es un divisor, container es un contenedor -->

        <div id="navbarSupportedContent" class="navbar-collapse collapse"> <!-- para que se adapte la barra a la pantalla --><!-- aca cargamos lo que queremos en nuestra barra-->
            <?php if (!ControlSesion::sesion_inciada()){ ?>
            <ul class="navbar-nav mr-auto"> <!-- el mr-auto lleva el cerrar sesion hacia la derecha ,ul es una lista desordenada -->
                <li class="nav-item">  <!-- dentro de la lista desordenada hay que colocar elemento de lista con la etiqueta <li> -->
                    <a class="nav-link" href="#"><!-- data-toggle="dropdown" es para que se pueda bajar los items o sino no baja items-->
                        <i class="fa fa-bars" aria-hidden="true"></i>
                        Entradas                                
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="#">
                        <i class="fa fa-star" aria-hidden="true"></i>
                        Favoritos                                
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="#">
                        <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                        Autores
                    </a> 
                </li>
            </ul> 
            <?php 
                }
            ?>
            <ul class="nav navbar-nav margin-left" ><!-- navbar-nav ubicamos  -->
                <?php
                if (ControlSesion::sesion_inciada()){
                ?>
                
                <li class="nav-link">
                    <a href="#">
                        <i class="fas fa-user"></i>
                        <?php echo ' ' . $_SESSION['nombre_usuario']; ?>
                        
                    </a>
                </li>
<!--                <li class="nav-item dropdown">-->
                    <a class="nav-link" href="<?php echo RUTA_GESTOR; ?>">
                        <i class="fas fa-expand"></i> Gestor 
                    </a>
                    <!--
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li>
                            <a class="dropdown-item" href="#">
                                Entradas
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">
                                Comentarios
                            </a>
                        </li> 
                        <li>
                            <a class="dropdown-item" href="#">
                                Usuarios
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">
                                Favoritos
                            </a>
                        </li> 
                    </ul>
                </li> -->
                
                        <a class="nav-link" href="<?php echo RUTA_LOGOUT; ?>">
                            <i class="fa fa-log-out"></i>
                            Cerrar Sesión
                        </a> 
                     
                     <!--   <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href=" //echo RUTA_LOGOUT;">Confirmar</a>
                        </ul> -->
                
                    
                    <?php
                } else {
                  ?>
                
                <li><a class="nav-link" href="#">                               
                            <i class="fas fa-users"></i>
                            <?php
                            echo $total_usuarios;
                            ?>
                        </a>                                                                                     
                </li>                             
                    <li><a class="nav-link" href="<?php echo RUTA_REGISTRO ?>">
                            <i class="fas fa-user-plus"></i>
                            Registarse
                        </a>                                                                                     
                    </li>
                <li><a class="nav-link" href="<?php echo RUTA_LOGIN ?>">
                            <i class="fa fa-sign-in"></i>
                            Iniciar Sesion
                        </a>                                                                                     
                </li>
                  
                      
                      
                  <?php
                }
                ?>
            </ul>
        </div>
    </div>
</nav> <!-- la diferencia entre class y id es que class podemos usar en varias partes pero el id solo en una etiqueta -->

