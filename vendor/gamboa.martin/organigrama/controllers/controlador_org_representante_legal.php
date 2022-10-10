<?php
/**
 * @author Martin Gamboa Vazquez
 * @version 1.0.0
 * @created 2022-05-14
 * @final En proceso
 *
 */
namespace gamboamartin\organigrama\controllers;

use gamboamartin\errores\errores;
use gamboamartin\system\links_menu;
use gamboamartin\system\system;
use gamboamartin\template\html;
use html\org_representante_legal_html;
use models\org_representante_legal;
use PDO;
use stdClass;

class controlador_org_representante_legal extends system {

    public function __construct(PDO $link, html $html = new \gamboamartin\template_1\html(),
                                stdClass $paths_conf = new stdClass()){
        $modelo = new org_representante_legal(link: $link);
        $html = new org_representante_legal_html($html);
        $obj_link = new links_menu($this->registro_id);
        parent::__construct(html:$html, link: $link,modelo:  $modelo, obj_link: $obj_link, paths_conf: $paths_conf);

        $this->titulo_lista = 'Actividades';

    }

    public function alta(bool $header, bool $ws = false): array|string
    {
        $r_alta =  parent::alta(header: false, ws: false); // TODO: Change the autogenerated stub
        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al generar template',data:  $r_alta, header: $header,ws:$ws);
        }



        $in_nombre = (new org_representante_legal_html(html: $this->html_base))->input(cols: 6,row_upd:  new stdClass(),value_vacio:  true, campo: "Nombre");
        $in_a_paterno = (new org_representante_legal_html(html: $this->html_base))->input(cols: 6,row_upd:  new stdClass(),value_vacio:  true, campo: "Apellido Paterno");
        $in_a_materno = (new org_representante_legal_html(html: $this->html_base))->input(cols: 6,row_upd:  new stdClass(),value_vacio:  true, campo: "Apellido Materno");
        $in_rfc = (new org_representante_legal_html(html: $this->html_base))->input(cols: 6,row_upd:  new stdClass(),value_vacio:  true, campo: "RFC");
        if(errores::$error){
            $error = $this->errores->error(mensaje: 'Error al generar el input',data:  $in_nombre);
            print_r($error);
            die('Error');
        }

        $this->inputs->nombre = $in_nombre;
        $this->inputs->a_paterno = $in_a_paterno;
        $this->inputs->a_materno = $in_a_materno;
        $this->inputs->rfc = $in_rfc;

        return $r_alta;
    }
}