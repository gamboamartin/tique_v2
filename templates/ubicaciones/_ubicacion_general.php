<?php

use base\conexion;
use config\generales;
use gamboamartin\errores\errores;
use models\wt_hogar;


$conf_database = new stdClass();

$paths_conf = new stdClass();
$paths_conf->generales = '/var/www/html/web_tique/config/generales.php';
$paths_conf->database = '/var/www/html/web_tique/config/database.php';
$paths_conf->views = '/var/www/html/web_tique/config/views.php';

$cnx = new conexion(paths_conf: $paths_conf);
$generales = new generales();

$wt_hogar_modelo = new wt_hogar(conexion::$link);


$landing_url = get_landing_url();
$landing_url_limpia = limpia_url_landing(url_landing: $landing_url);
$landing_url_sin_ext = quitar_php(url_landing_limpia: $landing_url_limpia);

$wt_hogar = $wt_hogar_modelo->obtener_registro_wt_hogar($landing_url_sin_ext);
$img_hogar = '';
$descripcion_hogar = '';



foreach ($wt_hogar_modelo->obten_registros_activos()->registros as $registro){
    echo $registro['wt_hogar_descripcion'];
    ?> <br> <?php
    echo $registro['wt_hogar_georeferencia'];
    ?> <br> <?php
    echo $registro['wt_hogar_ubicacion'];
    ?> <br> <?php
    echo $registro['wt_hogar_img_descripcion'];
    ?> <hr><br> <?php
}


if($wt_hogar > 0){
    $georeferencia_hogar = $wt_hogar['wt_hogar_georeferencia'];
    $ubicacion_hogar = $wt_hogar['wt_hogar_ubicacion'];
}
?>

<div class="widget widget-box box-container widget-property-map">
    <input name="georeferencia" id="georeferencia" value="<?php echo $georeferencia_hogar; ?>" hidden>
    <input name="ubicacion" id="ubicacion" value="<?php echo $ubicacion_hogar; ?>" hidden>
    <div class="widget-header text-uppercase">
        <h2>Ubicación</h2>
    </div>
    <div class="property-map" id='property-map-general' style='height: 385px;'></div>
    <div class="route_suggestion form-additional">
        <input id="route_from" class="inputtext w360 form-control" type="text" value="" placeholder="Escribe tu dirección" name="route_from" />
        <a id="route_from_button" href="#" class="btn-second">Ruta sugerida</a>
    </div>
</div>  <!-- /. widget-map and walkscore -->


