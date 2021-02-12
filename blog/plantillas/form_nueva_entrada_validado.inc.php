<div class="form-group">
    <label for="titulo">Título</label>
    <input type = "text" class="form-control" id="titulo" name="titulo" placeholder="Ingrese un titulo" <?php $validador -> mostrar_titulo(); ?> >
       <?php $validador -> mostrar_error_titulo(); ?>
</div>
<div class="form-group">
    <label for="url">URL</label>
    <input type = "text" class="form-control" name="url" id="url" <?php $validador -> mostrar_url(); ?> >
        <?php $validador -> mostrar_error_url(); ?>
</div>
<div class="form-group">
    <label for="contenido">Contendio</label>
    <textarea class="form-control" rows="5" id="contenido" name="texto" placeholder="Ingrese Texto" <?php $validador -> mostrar_texto(); ?> ></textarea>
        <?php $validador -> mostrar_error_texto(); ?>
</div>
<div class="check-box">
    <label>
        <input type="checkbox" name="publicar" value="si" <?php if($entrada_publica) echo 'checked'; ?> > Marca este recuadro si quieres que la entrada se publique de inmediato
    </label>
</div>
<br>
<div class="form-group">
    <button type="submit" class="btn btn-primary" name="guardar">Guardar Entrada</button>
</div>