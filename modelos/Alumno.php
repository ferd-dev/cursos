<?php
require_once '../config/conexion.php';

class Alumno
{
    public function __construct()
    {
        // 
    }

    public function listar()
    {
        $sql = "SELECT * FROM usuarios
                WHERE tipo = 'est'
                ORDER BY activo ASC";
        return ejecutarConsulta($sql);
    }

    public function crear($codigo, $nombre)
    {
        $sql = "INSERT INTO codigos (codigo, nombre) 
                    VALUES('$codigo', '$nombre')";
        return ejecutarConsulta($sql);
    }

    public function mostrar($id_codigo)
    {
        $sql = "SELECT * FROM codigos WHERE id_codigo = '$id_codigo'";
        return ejecutarConsultaSimpleFila($sql);
    }

    public function editar($id_codigo, $codigo, $nombre)
    {
        $sql = "UPDATE codigos SET codigo = '$codigo', nombre = '$nombre'
                    WHERE id_codigo = '$id_codigo' ";
        return ejecutarConsulta($sql);
    }

    public function activar($id_usuario)
    {
        $sql = "UPDATE usuarios 
                	SET activo = '1'
                	WHERE id_usuario = '$id_usuario'";
        return ejecutarConsulta($sql);
    }

    public function desactivar($id_usuario)
    {
        $sql = "UPDATE usuarios 
                    SET activo = '0' 
                    WHERE id_usuario = '$id_usuario'";
        return ejecutarConsulta($sql);
    }

    public function eliminar($id_codigo)
    {
        $sql = "DELETE FROM codigos 
                    WHERE id_codigo = '$id_codigo'";
        return ejecutarConsulta($sql);
    }
}
