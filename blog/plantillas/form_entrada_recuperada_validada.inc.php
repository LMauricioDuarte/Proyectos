<input type="hidden" id="id-entrada" name="id_entrada" value="<?php echo $id_entrada; ?>">
<div class="form-group">
    <label for="titulo">Título</label>
    <input type = "text" class="form-control" id="titulo" name="titulo" placeholder="Ingrese un titulo" value="<?php echo $validador -> obtener_titulo(); ?>">
    <input type="hidden" id="titulo-original" name="titulo-original" value="<?php echo $entrada_recuperada -> getTitulo(); ?>">
    
    <?php $validador -> mostrar_error_titulo(); ?>
    
</div>
<div class="form-group">
    <label for="url">URL</label>
    <input type = "text" class="form-control" name="url" id="url" value="<?php echo $validador -> obtener_url(); ?>">
    <input type = "hidden" name="url-original" id="url-original" value="<?php echo $entrada_recuperada -> getUrl(); ?>">
    
    <?php $validador -> mostrar_error_url(); ?>
    
</div> 
<div class="form-group">
    <label for="contenido">Contenido</label>
    <textarea class="form-control" rows="5" id="texto" name="texto" placeholder="Ingrese Texto"><?php echo $validador -> obtener_texto();?></textarea>
    <input type = "hidden" name="texto-original" id="texto-original" value="<?php echo $entrada_recuperada -> getTexto(); ?>">
    
    <?php $validador -> mostrar_error_texto(); ?>
    
</div>
<div class="check-box">
    <label>
        <input type="checkbox" name="publicar" value="si" <?php if ($validador -> obtener_checkbox()){ echo 'checked'; }?>>  Marca este recuadro si quieres que la entrada se publique de inmediato
        <input type="hidden" name="publicar-original" value="<?php echo $entrada_recuperada -> getActiva(); ?>">
    </label>
</div>
<br>
<div class="form-group">
    <button type="submit" class="btn btn-primary" name="guardar_cambios_entrada">Guardar Cambios</button>
</div>
            