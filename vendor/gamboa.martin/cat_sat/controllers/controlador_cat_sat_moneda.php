<?php
/**
 * @author Martin Gamboa Vazquez
 * @version 1.0.0
 * @created 2022-05-14
 * @final En proceso
 *
 */
namespace controllers;
use gamboamartin\errores\errores;
use gamboamartin\system\links_menu;
use gamboamartin\system\system;
use gamboamartin\template_1\html;
use html\cat_sat_moneda_html;
use html\dp_pais_html;
use models\cat_sat_moneda;
use PDO;
use stdClass;

class controlador_cat_sat_moneda extends system {
    public function __construct(PDO $link, stdClass $paths_conf = new stdClass()){
        $modelo = new cat_sat_moneda(link: $link);
        $html_base = new html();
        $html = new cat_sat_moneda_html(html: $html_base);
        $obj_link = new links_menu($this->registro_id);
        parent::__construct(html:$html, link: $link,modelo:  $modelo, obj_link: $obj_link, paths_conf: $paths_conf);

        $this->titulo_lista = 'Moneda';

    }

    public function  alta(bool $header, bool $ws = false): array|string
    {
        $r_alta =  parent::alta(header: false, ws: false); // TODO: Change the autogenerated stub
        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al generar template',data:  $r_alta, header: $header,ws:$ws);
        }

        $select = (new dp_pais_html(html: $this->html_base))->select_dp_pais_id(cols:12,con_registros: true,
            id_selected:-1,link: $this->link);
        if(errores::$error){
            $error = $this->errores->error(mensaje: 'Error al generar select',data:  $select);
            print_r($error);
            die('Error');
        }

        $this->inputs->select = new stdClass();
        $this->inputs->select->dp_pais_id = $select;

        return $r_alta;
    }






}
