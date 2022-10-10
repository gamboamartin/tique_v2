<?php /** @var base\controller\controlador_base $controlador  viene de registros del controler/lista */ ?>

<?php
use config\generales;
use config\views;
?>

        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet"/>
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<div class="control-group col-sm-6">
    <label class="control-label" for="id">Id</label>
    <div class="controls">
        <input type="text" name="id" value="<?php echo $controlador->row_upd->id; ?>" class="form-control" required="" id="id" placeholder="Id" readonly>
    </div>
</div>
<div class="control-group col-sm-6">
    <label class="control-label" for="descripcion">Descripcion</label>
    <div class="controls">
        <input type="text" name="descripcion" value="<?php echo $controlador->row_upd->descripcion; ?>" class="form-control" required="" id="descripcion" placeholder="Descripcion">
    </div>
</div>
<div class="control-group col-sm-6">
    <label class="control-label" for="descripcion_select">Descripcion Select</label>
    <div class="controls">
        <input type="text" name="descripcion_select" value="<?php echo $controlador->row_upd->descripcion_select; ?>" class="form-control" required="" id="descripcion_select" placeholder="Descripcion Select">
    </div>
</div>
<div class="control-group col-sm-6">
    <label class="control-label" for="codigo">Codigo</label>
    <div class="controls">
        <input type="text" name="codigo" value="<?php echo $controlador->row_upd->codigo; ?>" class="form-control" required="" id="codigo" placeholder="Codigo">
    </div>
</div>

<div class="control-group col-sm-6">
    <label class="control-label" for="url">Url</label>
    <div class="controls">
        <input type="text" name="url" value="<?php echo $controlador->row_upd->url; ?>" class="form-control" required="" id="Url" placeholder="Url">
    </div>
</div>
<div class="control-group col-sm-6">
    <label class="control-label" for="img_descripcion">Img Descripcion</label>
    <div class="controls">
        <input type="text" name="img_descripcion" value="<?php echo $controlador->row_upd->img_descripcion; ?>" class="form-control" required="" id="Url" placeholder="img_descripcion">
    </div>
</div>
<div class="control-group col-sm-6">
    <label class="control-label" for="georeferencia">Georeferencia</label>
    <div class="controls">
        <input type="text" name="georeferencia" value="<?php echo $controlador->row_upd->georeferencia; ?>" class="form-control" required="" id="georeferencia" placeholder="Georeferencia">
    </div>
</div>
<div class="control-group col-sm-6">
    <label class="control-label" for="ubicacion">Ubicacion</label>
    <div class="controls">
        <input type="text" name="ubicacion" value="<?php echo $controlador->row_upd->ubicacion; ?>" class="form-control" required="" id="ubicacion" placeholder="Ubicacion">
    </div>
</div>
<div class="control-group col-sm-6">
    <label class="control-label" for="wt_proposito">Proposito</label>
    <div class="controls">
        <?php echo $controlador->inputs->select->wt_proposito_id; ?>
    </div>
</div>
<div class="control-group col-sm-6">
    <label class="control-label" for="wt_proposito">Tipo Inmueble</label>
    <div class="controls">
        <?php echo $controlador->inputs->select->wt_tipo_inmueble_id; ?>
    </div>
</div>
<div class="control-group col-sm-6">
    <label class="control-label" for="terreno">Terreno</label>
    <div class="controls">
        <input type="text" name="terreno" value="<?php echo $controlador->row_upd->terreno; ?>" class="form-control" required="" id="terreno" placeholder="Terreno">
    </div>
</div>
<div class="control-group col-sm-6">
    <label class="control-label" for="construccion">Construccion</label>
    <div class="controls">
        <input type="text" name="construccion" value="<?php echo $controlador->row_upd->construccion; ?>" class="form-control" required="" id="construccion" placeholder="Construccion">
    </div>
</div>
<div class="control-group col-sm-6">
    <label class="control-label" for="niveles">Niveles</label>
    <div class="controls">
        <input type="text" name="niveles" value="<?php echo $controlador->row_upd->niveles; ?>" class="form-control" required="" id="niveles" placeholder="Niveles">
    </div>
</div>
<div class="control-group col-sm-6">
    <label class="control-label" for="banio">Baños</label>
    <div class="controls">
        <input type="text" name="banio" value="<?php echo $controlador->row_upd->banio; ?>" class="form-control" required="" id="banio" placeholder="Baños">
    </div>
</div>
<div class="control-group col-sm-6">
    <label class="control-label" for="recamara">Recamaras</label>
    <div class="controls">
        <input type="text" name="recamara" value="<?php echo $controlador->row_upd->recamara; ?>" class="form-control" required="" id="recamara" placeholder="Recamara">
    </div>
</div>
<div class="control-group col-sm-6">
    <label class="control-label" for="patio">Patio</label>
    <div class="controls">
        <input type="text" name="patio" value="<?php echo $controlador->row_upd->patio; ?>" class="form-control" required="" id="patio" placeholder="Patio">
    </div>
</div>
<div class="control-group col-sm-6">
    <label class="control-label" for="estacionamiento">Estacionamiento</label>
    <div class="controls">
        <input type="text" name="estacionamiento" value="<?php echo $controlador->row_upd->estacionamiento; ?>" class="form-control" required="" id="estacionamiento" placeholder="Estacionamiento">
    </div>
</div>

    <div class="row form-group">
        <div class="col-md-12 mb-3 mb-md-0">
            <div class="row form-group">
                <label class="control-label" for="observaciones">Observaciones</label>
            </div>
            <textarea class="form-control" name="observaciones" id="observaciones" required="true" cols="30" rows="5"><?php echo $controlador->row_upd->observaciones; ?></textarea>
        </div>
        <script>
            $('#observaciones').summernote({
                tabsize: 1,
                height: 100
            });
        </script>
    </div>


<?php include (new views())->ruta_templates.'botons/submit/modifica_bd.php';?>