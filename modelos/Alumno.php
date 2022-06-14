<?php
require_once '../config/conexion.php';

class Alumno
{
    public function listar()
    {
        $sql = "SELECT * FROM usuarios
                WHERE tipo = 'est'
                ORDER BY activo ASC";
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
