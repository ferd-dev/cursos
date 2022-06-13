<?php
require_once '../config/conexion.php';

class TipoArchivo
{
    public function __construct()
    {
        // 
    }

    public function listar()
    {
        $sql = "SELECT * FROM tipo_archivos
                ORDER BY activo ASC";
        return ejecutarConsulta($sql);
    }

    public function crear($nombre)
    {
        $sql = "INSERT INTO tipo_archivos (nombre, activo) 
                    VALUES('$nombre', 1)";
        return ejecutarConsulta($sql);
    }

    public function mostrar($id_tipo_archivo)
    {
        $sql = "SELECT * FROM tipo_archivos WHERE id_tipo_archivo = '$id_tipo_archivo'";
        return ejecutarConsultaSimpleFila($sql);
    }

    public function editar($id_tipo_archivo, $nombre)
    {
        $sql = "UPDATE tipo_archivos SET  nombre = '$nombre'
                    WHERE id_tipo_archivo = '$id_tipo_archivo' ";
        return ejecutarConsulta($sql);
    }

    public function activar($id_tipo_archivo)
    {
        $sql = "UPDATE tipo_archivos 
                	SET activo = '1'
                	WHERE id_tipo_archivo = '$id_tipo_archivo'";
        return ejecutarConsulta($sql);
    }

    public function desactivar($id_tipo_archivo)
    {
        $sql = "UPDATE tipo_archivos 
                    SET activo = '0' 
                    WHERE id_tipo_archivo = '$id_tipo_archivo'";
        return ejecutarConsulta($sql);
    }
}
