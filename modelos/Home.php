<?php
require_once '../config/conexion.php';

class Home
{
    public function obtenerNumAlumnos()
    {
        $sql = "SELECT COUNT(id_usuario) AS 'cantidad' FROM usuarios WHERE tipo = 'est'";
        return ejecutarConsultaSimpleFila($sql);
    }

    public function obtenerNumAdmin()
    {
        $sql = "SELECT COUNT(id_usuario) AS 'cantidad' FROM usuarios WHERE tipo = 'adm'";
        return ejecutarConsultaSimpleFila($sql);
    }

    public function obtenerNumCursos()
    {
        $sql = "SELECT COUNT(id_curso) AS 'cantidad' FROM cursos";
        return ejecutarConsultaSimpleFila($sql);
    }

    public function obtenerNumArchivos()
    {
        $sql = "SELECT COUNT(id_archivo) AS 'cantidad' FROM archivos";
        return ejecutarConsultaSimpleFila($sql);
    }
}
