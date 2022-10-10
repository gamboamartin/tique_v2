<?php
namespace config;

class views{
    public int $reg_x_pagina = 15; //Registros a mostrar en listas
    public string $titulo_sistema = 'web_tique'; //Titulo de sistema
    public string $ruta_template_base = "/var/www/html/inmobiliaria/vendor/gamboa.martin/template_1/";
    public string $ruta_templates= "/var/www/html/inmobiliaria/vendor/gamboa.martin/template_1/template/";
    public string $url_assets = '';

    public function __construct(){
        $url = 'http://localhost/web_tique/';
        $this->url_assets = $url. 'vendor/gamboa.martin/template_1/assets/';

    }

}


