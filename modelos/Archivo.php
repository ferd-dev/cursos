<?php
require_once '../config/conexion.php';

class Archivo
{
    public function listar($id_curso)
    {
        $sql = "SELECT a.*, ta.nombre AS 'nombre_tipo_archivo' 
                FROM archivos a
                INNER JOIN tipo_archivos ta
                ON a.id_tipo_archivo = ta.id_tipo_archivo
                WHERE id_curso = '$id_curso'
                ORDER BY activo ASC";
        return ejecutarConsulta($sql);
    }

    public function crear($id_tipo_archivo, $id_curso, $nombre, $descripcion, $ruta)
    {
        $sql = "INSERT INTO archivos (id_tipo_archivo, id_curso, nombre, descripcion, ruta, activo) 
                VALUES('$id_tipo_archivo', '$id_curso', '$nombre', '$descripcion', '$ruta', 1)";
        return ejecutarConsulta($sql);
    }

    public function mostrar($id_archivo)
    {
        $sql = "SELECT * FROM archivos WHERE id_archivo = '$id_archivo'";
        return ejecutarConsultaSimpleFila($sql);
    }

    public function editar($id_archivo, $id_tipo_archivo, $nombre, $descripcion, $ruta)
    {
        $sql = "UPDATE archivos 
                SET id_tipo_archivo = '$id_tipo_archivo', 
                    nombre = '$nombre',
                    descripcion = '$descripcion',
                    ruta = '$ruta'
                WHERE id_archivo = '$id_archivo'";
        return ejecutarConsulta($sql);
    }

    public function activar($id_archivo)
    {
        $sql = "UPDATE archivos 
                SET activo = 1
                WHERE id_archivo = '$id_archivo'";
        return ejecutarConsulta($sql);
    }

    public function desactivar($id_archivo)
    {
        $sql = "UPDATE archivos 
                    SET activo = 0
                    WHERE id_archivo = '$id_archivo'";
        return ejecutarConsulta($sql);
    }

    function obtenerTipoArchivo()
    {
        $sql = "SELECT * FROM tipo_archivos WHERE activo = 1";
        return ejecutarConsulta($sql);
    }

    public function obtenerDatosCurso($id_curso)
    {
        $sql = "SELECT * FROM cursos WHERE id_curso = '$id_curso'";
        return ejecutarConsultaSimpleFila($sql);
    }
}
