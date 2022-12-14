<?php
namespace links\secciones;
use gamboamartin\errores\errores;
use gamboamartin\system\links_menu;
use stdClass;

class link_org_empresa extends links_menu {
    public stdClass $links;


    private function link_org_empresa_alta(): array|string
    {
        $org_empresa_alta = $this->org_empresa_alta();
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al obtener link de org_empresa alta', data: $org_empresa_alta);
        }

        $org_empresa_alta.="&session_id=$this->session_id";
        return $org_empresa_alta;
    }

    /**
     * @param int $registro_id
     * @return array|string
     */
    private function link_org_empresa_ubicacion(int $registro_id): array|string
    {
        $org_empresa_ubicacion = $this->org_empresa_ubicacion(registro_id:$registro_id);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al obtener link de org_empresa ubicacion', data: $org_empresa_ubicacion);
        }

        $org_empresa_ubicacion.="&session_id=$this->session_id";
        return $org_empresa_ubicacion;
    }

    /**
     * @param int $registro_id
     * @return stdClass|array
     */
    protected function links(int $registro_id): stdClass|array
    {

        $links =  parent::links(registro_id: $registro_id); // TODO: Change the autogenerated stub
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar links', data: $links);
        }

        $org_empresa_alta = $this->link_org_empresa_alta();
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar link', data: $org_empresa_alta);
        }
        $this->links->org_empresa->nueva_empresa = $org_empresa_alta;

        $org_empresa_ubicacion = $this->link_org_empresa_ubicacion(registro_id: $registro_id);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar link', data: $org_empresa_ubicacion);
        }

        $this->links->org_empresa->ubicacion = $org_empresa_ubicacion;

        return $links;
    }

    /**
     * Genera un link a empresa alta sin session_id
     * @return string Un link de tipo seccion org_empresa accion alta
     * @version 0.6.0
     */
    private function org_empresa_alta(): string
    {
        return "./index.php?seccion=org_empresa&accion=alta";
    }

    /**
     * Genera un link de tipo ubicacion
     * @param int $registro_id Registro identificador
     * @version 0.85.22
     * @verfuncion 0.1.0
     * @author mgamboa
     * @fecha 2022-07-30 13:38
     * @return string
     */
    private function org_empresa_ubicacion(int $registro_id): string
    {
        return "./index.php?seccion=org_empresa&accion=ubicacion&registro_id=$registro_id";
    }


}
