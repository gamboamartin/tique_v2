<?php
namespace models\base;
use base\controller\controler;
use config\generales;
use gamboamartin\errores\errores;
use gamboamartin\validacion\validacion;
use models\dp_calle_pertenece;
use models\org_empresa;
use models\org_sucursal;
use PDO;
use stdClass;

class limpieza{
    private errores $error;
    private validacion $validacion;
    public function __construct(){
        $this->error = new errores();
        $this->validacion = new validacion();
    }

    /**
     * Genera la descripcion de una sucursal
     * @param array $dp_calle_pertenece registro de tipo calle
     * @param array $org_empresa registro de tipo empresa
     * @param array $registro registro de tipo sucursal
     * @return string|array
     * @version 0.156.31
     */
    private function descripcion_sucursal(array $dp_calle_pertenece, array $org_empresa, array $registro): string|array
    {
        $keys = array('org_empresa_descripcion');
        $valida = (new validacion())->valida_existencia_keys(keys: $keys,registro:  $org_empresa);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al validar org_empresa', data: $valida);
        }
        $keys = array('dp_municipio_descripcion','dp_estado_descripcion','dp_cp_descripcion');
        $valida = (new validacion())->valida_existencia_keys(keys: $keys,registro:  $dp_calle_pertenece);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al validar $dp_calle_pertenece', data: $valida);
        }
        $keys = array('codigo');
        $valida = (new validacion())->valida_existencia_keys(keys: $keys,registro:  $registro);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al validar $registro', data: $valida);
        }
        $descripcion = $org_empresa['org_empresa_descripcion'];
        $descripcion .= ' '.$dp_calle_pertenece['dp_municipio_descripcion'];
        $descripcion .= ' '.$dp_calle_pertenece['dp_estado_descripcion'];
        $descripcion .= ' '.$dp_calle_pertenece['dp_cp_descripcion'];
        $descripcion .= ' '.$registro['codigo'];

        return $descripcion;
    }

    /**
     * Genera una descripcion basada en org empresa
     * @param int $dp_calle_pertenece_id identificador de calle
     * @param PDO $link conexion a la bd
     * @param int $org_empresa_id identificador de empresa
     * @param array $registro registro previo
     * @return array|string
     */
    private function genera_descripcion(int $dp_calle_pertenece_id, PDO $link, int $org_empresa_id, array $registro): array|string
    {
        $org_empresa = (new org_empresa($link))->registro(registro_id: $org_empresa_id);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al obtener empresa', data: $org_empresa);
        }

        $dp_calle_pertenece = (new dp_calle_pertenece($link))->registro(registro_id: $dp_calle_pertenece_id);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al obtener calle', data: $dp_calle_pertenece);
        }


        $descripcion = $this->descripcion_sucursal(dp_calle_pertenece:$dp_calle_pertenece,
            org_empresa: $org_empresa,registro:  $registro);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al obtener descripcion', data: $descripcion);
        }

        return $descripcion;
    }

    /**
     * Inicializa la descripcion y el codigo de una empresa en alta bd
     * @param array $registro Registro en ejecucion
     * @version 0.56.14
     * @verfuncion 0.1.0
     * @author mgamboa
     * @fecha 2022-07-26 09:58
     * @return array
     */
    private function init_data_base_org_empresa(array $registro): array
    {
        if(!isset($registro['descripcion'])){
            $registro['descripcion'] = $registro['razon_social'];
        }
        if(!isset($this->registro['codigo_bis'])){
            $registro['codigo_bis'] = $registro['rfc'];
        }
        if(!isset($this->registro['descripcion_select'])){
            $registro['descripcion_select'] = $registro['descripcion'];
        }
        if(!isset($this->registro['alias'])){
            $registro['alias'] = $registro['descripcion'];
        }
        return $registro;
    }

    private function init_data_ubicacion_empresa(controler $controler, stdClass $org_empresa): stdClass
    {
        $controler->row_upd->dp_pais_id = $org_empresa->dp_pais_id;
        $controler->row_upd->dp_estado_id = $org_empresa->dp_estado_id;
        $controler->row_upd->dp_municipio_id = $org_empresa->dp_municipio_id;
        $controler->row_upd->dp_cp_id = $org_empresa->dp_cp_id;
        $controler->row_upd->dp_colonia_postal_id = $org_empresa->dp_colonia_postal_id;
        $controler->row_upd->dp_calle_pertenece_id = $org_empresa->dp_calle_pertenece_id;
        $controler->row_upd->dp_calle_pertenece_entre1_id = $org_empresa->org_empresa_dp_calle_pertenece_entre1_id;
        $controler->row_upd->dp_calle_pertenece_entre2_id = $org_empresa->org_empresa_dp_calle_pertenece_entre2_id;
        $controler->row_upd->org_tipo_empresa_id = $org_empresa->org_tipo_empresa_id;

        return $controler->row_upd;
    }
    private function init_data_ubicacion_sucursal(controler $controler, stdClass $org_sucursal): stdClass
    {
        $controler->row_upd->dp_pais_id = $org_sucursal->dp_pais_id;
        $controler->row_upd->dp_estado_id = $org_sucursal->dp_estado_id;
        $controler->row_upd->dp_municipio_id = $org_sucursal->dp_municipio_id;
        $controler->row_upd->dp_cp_id = $org_sucursal->dp_cp_id;
        $controler->row_upd->dp_colonia_postal_id = $org_sucursal->dp_colonia_postal_id;
        $controler->row_upd->dp_calle_pertenece_id = $org_sucursal->dp_calle_pertenece_id;
        $controler->row_upd->dp_calle_pertenece_entre1_id = $org_sucursal->org_empresa_dp_calle_pertenece_entre1_id;
        $controler->row_upd->dp_calle_pertenece_entre2_id = $org_sucursal->org_empresa_dp_calle_pertenece_entre2_id;


        return $controler->row_upd;
    }

    private function init_foraneas(array $keys_foraneas, stdClass $org_empresa): stdClass
    {
        foreach ($keys_foraneas as $campo){
            if(is_null($org_empresa->$campo)){
                $org_empresa->$campo = '-1';
            }
        }
        return $org_empresa;
    }

    public function init_modifica_org_empresa(controler $controler): array|stdClass
    {
        if(!isset($controler->row_upd)){
            $controler->row_upd = new stdClass();
        }
        if(!isset($controler->row_upd->cat_sat_regimen_fiscal_id)){
            $controler->row_upd->cat_sat_regimen_fiscal_id = -1;
        }


        $org_empresa = $controler->modelo->registro(registro_id: $controler->registro_id,retorno_obj: true);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al obtener registro',data:  $org_empresa);
        }


        $init = $this->init_upd_org_empresa(controler: $controler,org_empresa:  $org_empresa);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al inicializa datos',data:  $init);
        }
        return $init;
    }

    public function init_modifica_org_sucursal(controler $controler): array|stdClass
    {
        if(!isset($controler->row_upd)){
            $controler->row_upd = new stdClass();
        }


        $org_sucursal = $controler->modelo->registro(registro_id: $controler->registro_id,retorno_obj: true);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al obtener registro',data:  $org_sucursal);
        }


        $init = $this->init_upd_org_sucursal(controler: $controler,org_sucursal:  $org_sucursal);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al inicializa datos',data:  $init);
        }
        return $init;
    }

    /**
     * Inicializa los elemento de un registro previo al alta bd
     * @param array $registro Registro inicializar para el alta
     * @return array
     * @version 0.135.27
     * @verfuncion 0.1.0
     * @fecha 2022-08-08 12:36
     * @author mgamboa
     */
    public function init_org_empresa_alta_bd(array $registro): array
    {
        $keys = array('razon_social','rfc');
        $valida = $this->validacion->valida_existencia_keys(keys: $keys, registro: $registro);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al validar registro', data: $valida);
        }

        $registro = $this->init_data_base_org_empresa(registro:$registro);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al inicializar registro', data: $registro);
        }


        $registro = $this->limpia_foraneas_org_empresa(registro:$registro);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al limpiar registro', data: $registro);
        }

        return $registro;
    }

    private function init_upd_org_empresa(controler $controler, stdClass $org_empresa): array|stdClass
    {
        $keys_foraneas = array('dp_pais_id','dp_estado_id','dp_municipio_id','dp_cp_id','dp_colonia_postal_id',
            'dp_calle_pertenece_id','org_empresa_dp_calle_pertenece_entre1_id',
            'org_empresa_dp_calle_pertenece_entre2_id','org_tipo_empresa_id');


        $init = $this->init_foraneas(keys_foraneas: $keys_foraneas,org_empresa:  $org_empresa);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al inicializa datos',data:  $init);

        }


        $init = $this->init_data_ubicacion_empresa(controler: $controler,org_empresa:  $org_empresa);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al inicializa datos',data:  $init);
        }
        return $init;
    }

    private function init_upd_org_sucursal(controler $controler, stdClass $org_sucursal): array|stdClass
    {
        $keys_foraneas = array('dp_pais_id','dp_estado_id','dp_municipio_id','dp_cp_id','dp_colonia_postal_id',
            'dp_calle_pertenece_id');


        $init = $this->init_foraneas(keys_foraneas: $keys_foraneas,org_empresa:  $org_sucursal);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al inicializa datos',data:  $init);

        }


        $init = $this->init_data_ubicacion_sucursal(controler: $controler,org_sucursal:  $org_sucursal);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al inicializa datos',data:  $init);
        }
        return $init;
    }

    /**
     * Inicializa un registro previo al alta de sucursal desde empresa alta
     * @param org_sucursal $modelo Modelo de org sucursal datos
     * @return array
     */
    public function init_row_sucursal_alta(org_sucursal $modelo): array
    {
        $registro = $this->limpia_domicilio_con_calle(registro:$modelo->registro);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al limpiar sucursal', data: $registro);
        }

        $keys = array('descripcion');
        $valida = $this->validacion->valida_existencia_keys(keys: $keys,registro:  $registro);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al validar registro', data: $valida);
        }

        $registro['descripcion_select'] = strtoupper($registro['descripcion']);
        $registro['alias'] = $registro['codigo'];

        $modelo->registro = $registro;


        $org_tipo_sucursal_id =$this->row_tipo_sucursal_id(modelo: $modelo);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al asignar tipo sucursal',data:  $org_tipo_sucursal_id);
        }
        return $modelo->registro;
    }

    /**
     * Limpia un row cuando este tiene calle sus parents
     * @param array $registro registro a limpiar
     * @return array
     * @version 0.153.31
     */
    private function limpia_domicilio_con_calle(array $registro): array
    {
        $keys = array('dp_pais_id','dp_estado_id','dp_municipio_id','dp_cp_id','dp_colonia_postal_id');
        foreach ($keys as $key){
            if(isset($registro[$key])){
                unset($registro[$key]);
            }
        }

        return $registro;
    }



    /**
     * Limpia la llaves foraneas de la empresa a dar de alta
     * @param array $registro Registro en ejecucion
     * @version 0.58.14
     * @verfuncion 0.1.0
     * @author mgamboa
     * @fecha 2022-07-26 10:18
     * @return array
     */
    public function limpia_foraneas_org_empresa(array $registro): array
    {
        if(isset($registro['cat_sat_regimen_fiscal_id']) && (int)$registro['cat_sat_regimen_fiscal_id']===-1){
            unset($registro['cat_sat_regimen_fiscal_id']);
        }
        if(isset($registro['dp_calle_pertenece_id']) && (int)$registro['dp_calle_pertenece_id']===-1){
            unset($registro['dp_calle_pertenece_id']);
        }
        if(isset($registro['dp_calle_pertenece_entre2_id']) && (int)$registro['dp_calle_pertenece_entre2_id']===-1){
            unset($registro['dp_calle_pertenece_entre2_id']);
        }
        if(isset($registro['dp_calle_pertenece_entre1_id']) && (int)$registro['dp_calle_pertenece_entre1_id']===-1){
            unset($registro['dp_calle_pertenece_entre1_id']);
        }
        return $registro;
    }

    /**
     * Maqueta un arreglo con los datos para la insersion de una sucursal con datos de la empresa
     * @param PDO $link Conexion a la base de datos
     * @param int $org_empresa_id identificador
     * @param array $org_empresa registro de tipo empresa
     * @return array
     */
    public function org_sucursal_ins(PDO $link, int $org_empresa_id, array $org_empresa): array
    {

        $org_empresa_ = $org_empresa;
        if(!isset($org_empresa_['codigo_bis'])){
            $org_empresa_ = (new org_empresa($link))->registro(registro_id: $org_empresa_id,columnas_en_bruto: true);
        }

        $org_sucursal_ins['org_empresa_id'] = $org_empresa_id;
        $org_sucursal_ins['codigo'] = $org_empresa_['codigo'];
        $org_sucursal_ins['codigo_bis'] = $org_empresa_['codigo_bis'];
        $org_sucursal_ins['descripcion'] = $org_empresa_['descripcion'];


        if(isset($org_empresa_['fecha_inicio_operaciones'])){
            $org_sucursal_ins['fecha_inicio_operaciones'] = $org_empresa_['fecha_inicio_operaciones'];
        }
        if(isset($org_empresa_['dp_calle_pertenece_id'])){
            $org_sucursal_ins['dp_calle_pertenece_id'] = $org_empresa_['dp_calle_pertenece_id'];
        }
        if(isset($org_empresa_['telefono_1'])){
            $org_sucursal_ins['telefono_1'] = $org_empresa_['telefono_1'];
        }
        if(isset($org_empresa_['telefono_2'])){
            $org_sucursal_ins['telefono_2'] = $org_empresa_['telefono_2'];
        }
        if(isset($org_empresa_['telefono_3'])){
            $org_sucursal_ins['telefono_3'] = $org_empresa_['telefono_3'];
        }
        if(isset($org_empresa_['exterior'])){
            $org_sucursal_ins['exterior'] = $org_empresa_['exterior'];
        }
        if(isset($org_empresa_['interior'])){
            $org_sucursal_ins['interior'] = $org_empresa_['interior'];
        }

        return $org_sucursal_ins;
    }

    private function row_tipo_sucursal_id(org_sucursal $modelo): int|array
    {
        if(!isset($modelo->registro['tipo_sucursal_id'])){

            $t_sucursal = $this->tipos_sucursal();
            if(errores::$error){
                return $this->error->error(mensaje: 'Error al obtener tipos de sucursal', data: $t_sucursal);
            }

            $org_tipo_sucursal_id = $this->tipo_sucursal_id(modelo: $modelo, t_sucursal: $t_sucursal);
            if(errores::$error){
                return $this->error->error(mensaje: 'Error al obtener tipo sucursal',data:  $org_tipo_sucursal_id);
            }

            $modelo->registro['org_tipo_sucursal_id'] = $org_tipo_sucursal_id;

        }
        return  (int)$modelo->registro['org_tipo_sucursal_id'];
    }

    private function tipos_sucursal(): stdClass
    {
        $generales = (new generales());
        $tipo_sucursal_base_id = -1;
        $tipo_sucursal_matriz_id = -1;
        if(isset($generales->tipo_sucursal_base_id)){
            $tipo_sucursal_base_id = $generales->tipo_sucursal_base_id;
        }
        if(isset($generales->tipo_sucursal_matriz_id)){
            $tipo_sucursal_matriz_id = $generales->tipo_sucursal_matriz_id;
        }

        $data = new stdClass();
        $data->tipo_sucursal_base_id = $tipo_sucursal_base_id;
        $data->tipo_sucursal_matriz_id = $tipo_sucursal_matriz_id;
        return $data;
    }

    private function tipo_sucursal_id(org_sucursal $modelo, stdClass $t_sucursal): array|int
    {
        $org_tipo_sucursal_id = -1;
        $filtro = array();
        $filtro['org_empresa.id'] = $modelo->registro['org_empresa_id'];
        $n_sucursales = $modelo->cuenta(filtro: $filtro);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al contar sucursales',data:  $n_sucursales);
        }
        if((int)$n_sucursales === 0){
            $org_tipo_sucursal_id = $t_sucursal->tipo_sucursal_matriz_id;
        }
        if((int)$n_sucursales >0){
            $filtro = array();
            $filtro['org_empresa.id'] = $modelo->registro['org_empresa_id'];
            $filtro['org_tipo_sucursal.id'] = $t_sucursal->tipo_sucursal_matriz_id;
            $n_sucursales = $modelo->cuenta(filtro: $filtro);
            if(errores::$error){
                return $this->error->error(mensaje: 'Error al contar sucursales',data:  $n_sucursales);
            }
            if((int)$n_sucursales === 0){
                $org_tipo_sucursal_id = $t_sucursal->tipo_sucursal_matriz_id;
            }
            else{
                $org_tipo_sucursal_id = $t_sucursal->tipo_sucursal_base_id;
            }
        }
        return $org_tipo_sucursal_id;
    }



}
