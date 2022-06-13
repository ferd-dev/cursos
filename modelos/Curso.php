<?php
require_once '../config/conexion.php';

class Curso
{
    public function listar()
    {
        $sql = "SELECT * FROM cursos
                ORDER BY activo ASC";
        return ejecutarConsulta($sql);
    }

    public function crear($nombre, $descripcion, $materia)
    {
        $sql = "INSERT INTO cursos (nombre, descripcion, materia, activo) 
                VALUES('$nombre', '$descripcion', '$materia', 1)";
        return ejecutarConsulta($sql);
    }

    public function mostrar($id_curso)
    {
        $sql = "SELECT * FROM cursos WHERE id_curso = '$id_curso'";
        return ejecutarConsultaSimpleFila($sql);
    }

    public function editar($id_curso, $nombre, $descripcion, $materia)
    {
        $sql = "UPDATE cursos SET nombre = '$nombre', descripcion = '$descripcion', materia = '$materia'
                WHERE id_curso = '$id_curso' ";
        return ejecutarConsulta($sql);
    }

    public function activar($id_curso)
    {
        $sql = "UPDATE cursos 
                SET activo = 1
                WHERE id_curso = '$id_curso'";
        return ejecutarConsulta($sql);
    }

    public function desactivar($id_curso)
    {
        $sql = "UPDATE cursos 
                    SET activo = 0
                    WHERE id_curso = '$id_curso'";
        return ejecutarConsulta($sql);
    }
}
