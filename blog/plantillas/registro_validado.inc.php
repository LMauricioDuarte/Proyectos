<div class="form-group"
     <label>Nombre de Usuario</label>
    <input type="text" class="form-control" name="nombre" placeholder="Nombre" <?php $validador -> mostrar_nombre()?>>
    <?php
    $validador -> mostrar_error_nombre();
    ?>
</div>
<div class="form-group"
     <label>Email</label>
    <input type="email" class="form-control" name="email" placeholder="Correo Electronico" <?php $validador -> mostrar_email()?>>
    <?php
    $validador -> mostrar_error_email();
    ?>
</div>
<div class="form-group"
     <label>Contraseña</label>
    <input type="password" class="form-control" name="clave1" >
    <?php
    $validador -> mostrar_error_clave1();
    ?>
</div>
<div class="form-group"
     <label>Repite la Contraseña</label>
    <input type="password" class="form-control" name ="clave2">
    <?php
    $validador -> mostrar_error_clave2();
    ?>
</div>
<br>
<button type="reset" class="btn btn-default btn-primary">Limpiar Datos</button>
<button type="submit" class="btn btn-default btn-primary" name="enviar">Enviar Datos</button>
