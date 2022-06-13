<?php
require_once '../config/conexion.php';

class CursoEstudiante
{
    public function listar()
    {
        $sql = "SELECT * FROM cursos
                WHERE activo = 1
                ORDER BY id_curso DESC";
        return ejecutarConsulta($sql);
    }

    public function obtenerDatosCurso($id_curso)
    {
        $sql = "SELECT * FROM cursos WHERE id_curso = '$id_curso'";
        return ejecutarConsultaSimpleFila($sql);
    }

    public function obtenerArchivos($id_curso)
    {
        $sql = "SELECT a.*, ta.nombre AS 'nombre_tipo_archivo' 
                FROM archivos a
                INNER JOIN tipo_archivos ta
                ON a.id_tipo_archivo = ta.id_tipo_archivo
                WHERE id_curso = '$id_curso'
                ORDER BY id_archivo DESC";
        return ejecutarConsulta($sql);
    }
}
