<?php
namespace tests\controllers;

use controllers\controlador_cat_sat_tipo_persona;
use gamboamartin\errores\errores;
use gamboamartin\test\liberator;
use gamboamartin\test\test;
use JsonException;
use models\adm_dia;

use models\fc_factura;
use models\fc_partida;
use stdClass;


class fc_facturaTest extends test {
    public errores $errores;
    private stdClass $paths_conf;
    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->errores = new errores();
        $this->paths_conf = new stdClass();
        $this->paths_conf->generales = '/var/www/html/cat_sat/config/generales.php';
        $this->paths_conf->database = '/var/www/html/cat_sat/config/database.php';
        $this->paths_conf->views = '/var/www/html/cat_sat/config/views.php';
    }

    public function test_descuento_partida(): void
    {
        errores::$error = false;

        $_GET['seccion'] = 'cat_sat_tipo_persona';
        $_GET['accion'] = 'lista';
        $_SESSION['grupo_id'] = 1;
        $_SESSION['usuario_id'] = 2;
        $_GET['session_id'] = '1';

        $modelo = new fc_factura($this->link);
        $modelo = new liberator($modelo);

        $fc_partida_id = 1;
        $resultado = $modelo->descuento_partida($fc_partida_id);
        $this->assertIsFloat($resultado);
        $this->assertNotTrue(errores::$error);
        $this->assertEquals(1,$resultado);
        errores::$error = false;
    }

    public function test_get_partidas(): void
    {
        errores::$error = false;

        $_GET['seccion'] = 'cat_sat_tipo_persona';
        $_GET['accion'] = 'lista';
        $_SESSION['grupo_id'] = 1;
        $_SESSION['usuario_id'] = 2;
        $_GET['session_id'] = '1';

        $modelo = new fc_factura($this->link);
        $modelo = new liberator($modelo);

        $fc_factura_id = 1;
        $resultado = $modelo->get_partidas($fc_factura_id);


        $this->assertIsArray($resultado);
        $this->assertNotTrue(errores::$error);


        errores::$error = false;
    }

    public function test_sub_total(): void
    {
        errores::$error = false;

        $_GET['seccion'] = 'cat_sat_tipo_persona';
        $_GET['accion'] = 'lista';
        $_SESSION['grupo_id'] = 1;
        $_SESSION['usuario_id'] = 2;
        $_GET['session_id'] = '1';

        $modelo = new fc_factura($this->link);
        //$modelo = new liberator($modelo);

        $fc_partida_id = 1;
        $resultado = $modelo->sub_total($fc_partida_id);
        $this->assertIsFloat($resultado);
        $this->assertNotTrue(errores::$error);
        $this->assertEquals(1,$resultado);
        errores::$error = false;

    }

    public function test_sub_total_partida(): void
    {
        errores::$error = false;

        $_GET['seccion'] = 'cat_sat_tipo_persona';
        $_GET['accion'] = 'lista';
        $_SESSION['grupo_id'] = 1;
        $_SESSION['usuario_id'] = 2;
        $_GET['session_id'] = '1';

        $modelo = new fc_factura($this->link);
        $modelo = new liberator($modelo);

        $fc_partida_id = 1;
        $resultado = $modelo->sub_total_partida($fc_partida_id);
        $this->assertIsFloat($resultado);
        $this->assertNotTrue(errores::$error);
        $this->assertEquals(1,$resultado);
        errores::$error = false;
    }


}

