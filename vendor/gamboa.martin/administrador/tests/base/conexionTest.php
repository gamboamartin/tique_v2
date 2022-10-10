<?php
namespace tests\base;

use base\conexion;
use config\database;
use gamboamartin\errores\errores;
use gamboamartin\test\liberator;
use gamboamartin\test\test;
use JsonException;
use stdClass;


class conexionTest extends test {
    public errores $errores;
    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->errores = new errores();
    }

    /**
     * @throws JsonException
     */
    public function test_asigna_set_names(): void
    {
        errores::$error = false;

        $paths = new stdClass();


        $paths->generales = '/var/www/html/administrador/config/generales.php';
        $paths->database = '/var/www/html/administrador/config/database.php';
        $paths->views = '/var/www/html/administrador/config/views.php';

        $cnx = new conexion($paths);
        $cnx = new liberator($cnx);

        $set_name = 'utf8';
        $resultado = $cnx->asigna_set_names(conexion::$link, $set_name);

        $this->assertNotTrue(errores::$error);
        $this->assertIsObject($resultado);


    }

    /**
     * @throws JsonException
     */
    public function test_conecta(): void
    {
        errores::$error = false;

        $paths = new stdClass();


        $paths->generales = '/var/www/html/administrador/config/generales.php';
        $paths->database = '/var/www/html/administrador/config/database.php';
        $paths->views = '/var/www/html/administrador/config/views.php';

        $cnx = new conexion($paths);
        $cnx = new liberator($cnx);
        $conf_database = new database();
        $conf_database->db_user = '';
        $resultado = $cnx->conecta($conf_database, 'MYSQL');

        $this->assertIsArray( $resultado);
        $this->assertTrue(errores::$error);
        $this->assertStringContainsStringIgnoringCase('Error al validar conf_database',$resultado['mensaje']);

        errores::$error = false;

        $conf_database->db_user = 'x';
        $conf_database = new database();
        $conf_database->db_user = '';
        $resultado = $cnx->conecta($conf_database, 'MYSQL');
        $this->assertIsArray( $resultado);
        $this->assertTrue(errores::$error);
        $this->assertStringContainsStringIgnoringCase('Error al validar conf_database',$resultado['mensaje']);

        errores::$error = false;

        $conf_database = new database();

        $resultado = $cnx->conecta($conf_database, 'MYSQL');
        $this->assertIsObject( $resultado);
        $this->assertNotTrue(errores::$error);
        $this->assertIsObject($resultado);


        errores::$error = false;
    }










}